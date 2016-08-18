<?php

namespace AdLib\CreativeSelector;

use AdLib\Model\Campaign;

class RandomCreativeSelector implements CreativeSelectorInterface
{
    public function select(Campaign $campaign)
    {
        $creatives = $campaign->getCreatives();
        $length = count($creatives);
        if ($length == 0) {
            return null;
        }
        $id = rand(0, $length-1);
        return $creatives[$id];
    }
}
