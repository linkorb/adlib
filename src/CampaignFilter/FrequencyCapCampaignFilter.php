<?php

namespace AdLib\CampaignFilter;

use AdLib\Model\Campaign;
use AdLib\Model\Request;
use AdLib\Model\Slot;

class FrequencyCapCampaignFilter implements CampaignFilterInterface
{
    protected $impressionRepository;

    public function __construct($impressionRepository)
    {
        $this->impressionRepository = $impressionRepository;
    }

    public function filter(Campaign $campaign, Slot $slot)
    {
        $request = $slot->getRequest();
        $stamp = $request->getTimestamp();
        if ($campaign->getFlightStart() < $stamp) {
            if ($campaign->getFlightEnd() > $stamp) {
                return true;
            }
        }
        return false;
    }
}
