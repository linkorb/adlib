<?php

namespace AdLib\Model;

class Exclude
{
    protected $campaign;
    protected $filter;
    
    public function getCampaign()
    {
        return $this->campaign;
    }
    
    public function setCampaign($campaign)
    {
        $this->campaign = $campaign;
        return $this;
    }
    
    public function getFilter()
    {
        return $this->filter;
    }
    
    public function setFilter($filter)
    {
        $this->filter = $filter;
        return $this;
    }
}
