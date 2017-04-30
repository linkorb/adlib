<?php

namespace AdLib\CampaignFilter;

use AdLib\Model\Campaign;
use AdLib\Model\Slot;

class FlightCampaignFilter implements CampaignFilterInterface
{
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
