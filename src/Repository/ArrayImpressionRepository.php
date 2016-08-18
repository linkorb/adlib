<?php

namespace AdLib\Repository;

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
}
