<?php

namespace AdLib\CampaignFilter;

use AdLib\Model\Campaign;
use AdLib\Model\Request;
use AdLib\Model\Criterion;
use AdLib\Model\Slot;
use RuntimeException;

class PropertyCampaignFilter implements CampaignFilterInterface
{
    public function filter(Campaign $campaign, Slot $slot)
    {
        $request = $slot->getRequest();

        $stamp = $request->getTimestamp();

        $match = true;
        foreach ($campaign->getCriteria() as $criterion) {
            if (!$this->checkCriterion($criterion, $request)) {
                $match = false;
            }
        }
        return $match;
    }

    protected function checkCriterion(Criterion $criterion, Request $request)
    {
        $key = $criterion->getKey();
        if (!$request->hasProperty($key)) {
            return false;
        }
        $requestValue = $request->getProperty($key);

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
