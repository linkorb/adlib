<?php

namespace AdLib\CampaignFilter;

use AdLib\Model\Campaign;
use AdLib\Model\Request;
use AdLib\Model\Zone;

class SizeCampaignFilter implements CampaignFilterInterface
{
    public function filter(Campaign $campaign, Request $request, Zone $zone)
    {
        if ($campaign->getWidth() == $zone->getWidth()) {
            if ($campaign->getHeight() == $zone->getHeight()) {
                return true;
            }
        }
        return false;
    }
}
