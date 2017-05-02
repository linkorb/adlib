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

        if ($campaign->getFlightStart()) {
            if ($campaign->getFlightStart() > $stamp) {
                return false;
            }
        }

        if ($campaign->getFlightEnd()) {
            if ($campaign->getFlightEnd() < $stamp) {
                return false;
            }
        }
        return true;
    }
}
