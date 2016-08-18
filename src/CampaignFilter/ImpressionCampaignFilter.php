<?php

namespace AdLib\CampaignFilter;

use AdLib\Model\Campaign;
use AdLib\Model\Request;

class ImpressionCampaignFilter implements CampaignFilterInterface
{
    protected $impressionRepository;
    protected $impressions;
    
    public function __construct($impressionRepository)
    {
        $this->impressionRepository = $impressionRepository;
        $this->impressions = $this->impressionRepository->getImpressionsPerCampaign();
    }
    
    public function filter(Campaign $campaign, Request $request)
    {
        if ($campaign->getGoalType() != 'impressions') {
            return true;
        }
        
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
