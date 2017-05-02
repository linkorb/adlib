<?php

namespace AdLib\CampaignFilter;

use AdLib\Model\Campaign;
use AdLib\Model\Slot;
use AdLib\Model\Zone;

class SizeCampaignFilter implements CampaignFilterInterface
{
    public function filter(Campaign $campaign, Slot $slot)
    {
        $zone = $slot->getZone();
        if ((int)$campaign->getWidth() == (int)$zone->getWidth()) {
            if ((int)$campaign->getHeight() == (int)$zone->getHeight()) {
                return true;
            }
        }
        return false;
    }
}
