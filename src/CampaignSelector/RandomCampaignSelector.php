<?php

namespace AdLib\CampaignSelector;

use AdLib\Model\Network;
use AdLib\Model\Request;

class RandomCampaignSelector implements CampaignSelectorInterface
{
    public function select($campaigns)
    {
        $length = count($campaigns);
        if ($length > 0) {
            $id = rand(0, $length-1);
            $campaign = $campaigns[$id];
            return $campaign;
        }
        return null;
    }
}
