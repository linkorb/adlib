<?php

namespace AdLib\CampaignSelector;

use AdLib\Model\Network;
use AdLib\Model\Request;

class RandomCampaignSelector implements CampaignSelectorInterface
{
    /*
    protected $network;
    public function __construct(Network $network)
    {
        $this->network = $network;
    }
    */
    
    public function select($campaigns)
    {
        $length = count($campaigns);
        if ($length == 0) {
            return null;
        }
        $id = rand(0, $length-1);
        $campaign = $campaigns[$id];
        return $campaign;
    }
}
