<?php

namespace AdLib\CampaignFilter;

use AdLib\Model\Campaign;
use AdLib\Model\Request;
use AdLib\Model\Slot;
use AdLib\Model\Zone;

class ImpressionCampaignFilter implements CampaignFilterInterface
{
    protected $impressionRepository;
    protected $impressions;

    public function __construct($impressionRepository)
    {
        $this->impressionRepository = $impressionRepository;
        $this->impressions = $this->impressionRepository->getImpressionsPerCampaign();
    }

    public function filter(Campaign $campaign, Slot $slot)
    {
        if ($campaign->getGoalType() != 'impressions') {
            return true;
        }
        $request = $slot->getRequest();


        $i = 0;
        if (isset($this->impressions[$campaign->getId()])) {
            $i = $this->impressions[$campaign->getId()];
        }
        if ($i < $campaign->getGoalQuantity()) {
            // goal not yet reached
            return true;
        }
        return false;
    }
}
