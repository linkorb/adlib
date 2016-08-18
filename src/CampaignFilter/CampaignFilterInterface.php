<?php

namespace AdLib\CampaignFilter;

use AdLib\Model\Campaign;
use AdLib\Model\Request;

interface CampaignFilterInterface
{
    public function filter(Campaign $campaign, Request $request);
}
