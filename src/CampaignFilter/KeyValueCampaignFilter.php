<?php

namespace AdLib\CampaignFilter;

use AdLib\Model\Campaign;
use AdLib\Model\Request;
use AdLib\Model\Criterion;
use RuntimeException;

class KeyValueCampaignFilter implements CampaignFilterInterface
{
    public function filter(Campaign $campaign, Request $request)
    {
        $stamp = $request->getTimestamp();
        
        $match = true;
        foreach ($campaign->getCriteria() as $criterion) {
            if (!$this->checkCriterion($criterion, $request)) {
                $match = false;
            }
        }
        return $match;
    }
    
    public function checkCriterion(Criterion $criterion, $request)
    {
        $key = $criterion->getKey();
        if (!$request->hasKey($key)) {
            return false;
        }
        $requestValue = $request->getKey($key);
    
        $values = $criterion->getValue();
        if (!is_array($values)) {
            $values = [$values];
        }
        
        $match = false;
        foreach ($values as $value) {
            switch (strtolower($criterion->getMatch())) {
                case 'equals':
                    if ($requestValue == $value) {
                        $match = true;
                    }
                    break;
                default:
                    throw new RuntimeException('Unsupported match type: ' . $request->getMatch());
            }
        }
        return $match;
    }
}
