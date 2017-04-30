<?php

namespace AdLib\CampaignFilter;

use AdLib\Model\Campaign;
use AdLib\Model\Slot;

interface CampaignFilterInterface
{
    public function filter(Campaign $campaign, Slot $slot);
}
