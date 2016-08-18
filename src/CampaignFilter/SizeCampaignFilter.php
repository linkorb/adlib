<?php

namespace AdLib\CampaignFilter;

use AdLib\Model\Campaign;
use AdLib\Model\Request;

class SizeCampaignFilter implements CampaignFilterInterface
{
    public function filter(Campaign $campaign, Request $request)
    {
        if ($campaign->getWidth() == $request->getWidth()) {
            if ($campaign->getHeight() == $request->getHeight()) {
                return true;
            }
        }
        return false;
    }
}
