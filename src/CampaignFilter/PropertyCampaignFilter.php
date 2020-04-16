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
        $properties = array_merge_recursive(
            $request->getProperties(),
            $slot->getZone()->getProperties()
        );

        // Check campaign criteria
        foreach ($campaign->getCriteria() as $criterion) {
            if (!$this->checkCriterion($criterion, $properties)) {
                $match = false;
            }
        }
        
        // Check zone criteria
        foreach ($slot->getZone()->getCriteria() as $criterion) {
            if (!$this->checkCriterion($criterion, $properties)) {
                $match = false;
            }
        }
        return $match;
    }

    protected function checkCriterion(Criterion $criterion, $properties)
    {
        $key = $criterion->getKey();
        if (!isset($properties[$key])) {
            return false;
        }
        $propertyValue = $properties[$key];

        $criterionValues = $criterion->getValue();
        if (!is_array($criterionValues)) {
            $criterionValues = [$criterionValues];
        }

        $match = false;
        foreach ($criterionValues as $criterionValue) {
            switch (strtolower($criterion->getOperator())) {
                case 'equals':
                    if ($propertyValue == $criterionValue) {
                        $match = true;
                    }
                    break;
                default:
                    throw new RuntimeException('Unsupported match type: ' . $criterion->getOperator());
            }
        }
        return $match;
    }
}
