<?php

namespace AdLib\Model;

class FrequencyCap
{
    protected $type; // session
    protected $impressions;
    protected $span;
    protected $unit; // hours, minutes, days
    
    public function getType()
    {
        return $this->type;
    }
    
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    
    public function getImpressions()
    {
        return $this->impressions;
    }
    
    public function setImpressions($impressions)
    {
        $this->impressions = $impressions;
        return $this;
    }
    
    public function getSpan()
    {
        return $this->span;
    }
    
    public function setSpan($span)
    {
        $this->span = $span;
        return $this;
    }
    
    public function getUnit()
    {
        return $this->unit;
    }
    
    public function setUnit($unit)
    {
        $this->unit = $unit;
        return $this;
    }
    
}
