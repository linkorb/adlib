<?php

namespace AdLib\CampaignFilter;

use AdLib\Model\Campaign;
use AdLib\Model\Request;

class FrequencyCapCampaignFilter implements CampaignFilterInterface
{
    protected $impressionRepository;
    
    public function __construct($impressionRepository)
    {
        $this->impressionRepository = $impressionRepository;
    }
    
    public function filter(Campaign $campaign, Request $request)
    {
        $stamp = $request->getTimestamp();
        if ($campaign->getFlightStart() < $stamp) {
            if ($campaign->getFlightEnd() > $stamp) {
                return true;
            }
        }
        return false;
    }
}
