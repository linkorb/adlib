<?php

namespace AdLib\Repository;

use Adlib\Model\Request;

class ArrayImpressionRepository
{
    public function setImpressionsPerCampaign($data)
    {
        $this->impressionsPerCampaign = $data;
    }

    public function getImpressionsPerCampaign()
    {
        return $this->impressionsPerCampaign;
    }

    public function saveRequest(Request $request)
    {
        // nop
    }
}
