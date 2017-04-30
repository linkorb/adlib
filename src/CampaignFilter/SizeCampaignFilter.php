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
        if ($campaign->getWidth() == $zone->getWidth()) {
            if ($campaign->getHeight() == $zone->getHeight()) {
                return true;
            }
        }
        return false;
    }
}
