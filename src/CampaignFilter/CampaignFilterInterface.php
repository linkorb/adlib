<?php

namespace AdLib\CampaignFilter;

use AdLib\Model\Campaign;
use AdLib\Model\Request;
use AdLib\Model\Zone;

interface CampaignFilterInterface
{
    public function filter(Campaign $campaign, Request $request, Zone $zone);
}
