<?php

namespace AdLib\Model;

class Campaign
{
    protected $name;
    protected $mode;
    protected $priority;
    protected $comment;
    protected $flightStart;
    protected $flightEnd;
    protected $flightTimezone;
    
    protected $goalQuantity;
    protected $goalType;
    protected $goalMode;
    
    protected $ratePrice;
    protected $rateCurrency;
    protected $rateType;
    protected $rateDiscountAmount;
    protected $rateDiscountType;
    
    protected $criteria = [];
    protected $frequencyCaps = [];
    protected $creatives = [];
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    public function getMode()
    {
        return $this->mode;
    }
    
    public function setMode($mode)
    {
        $this->mode = $mode;
        return $this;
    }
    
    public function getPriority()
    {
        return $this->priority;
    }
    
    public function setPriority($priority)
    {
        $this->priority = $priority;
        return $this;
    }
    
    public function getComment()
    {
        return $this->comment;
    }
    
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }
    
    public function getFlightStart()
    {
        return $this->flightStart;
    }
    
    public function setFlightStart($flightStart)
    {
        $this->flightStart = $flightStart;
        return $this;
    }
    
    public function getFlightEnd()
    {
        return $this->flightEnd;
    }
    
    public function setFlightEnd($flightEnd)
    {
        $this->flightEnd = $flightEnd;
        return $this;
    }
    
    public function getFlightTimezone()
    {
        return $this->flightTimezone;
    }
    
    public function setFlightTimezone($flightTimezone)
    {
        $this->flightTimezone = $flightTimezone;
        return $this;
    }
    
    public function getGoalQuantity()
    {
        return $this->goalQuantity;
    }
    
    public function setGoalQuantity($goalQuantity)
    {
        $this->goalQuantity = $goalQuantity;
        return $this;
    }
    
    public function getGoalType()
    {
        return $this->goalType;
    }
    
    public function setGoalType($goalType)
    {
        $this->goalType = $goalType;
        return $this;
    }
    
    public function getGoalMode()
    {
        return $this->goalMode;
    }
    
    public function setGoalMode($goalMode)
    {
        $this->goalMode = $goalMode;
        return $this;
    }
    
    public function getRatePrice()
    {
        return $this->ratePrice;
    }
    
    public function setRatePrice($ratePrice)
    {
        $this->ratePrice = $ratePrice;
        return $this;
    }
    
    public function getRateCurrency()
    {
        return $this->rateCurrency;
    }
    
    public function setRateCurrency($rateCurrency)
    {
        $this->rateCurrency = $rateCurrency;
        return $this;
    }
    
    public function getRateType()
    {
        return $this->rateType;
    }
    
    public function setRateType($rateType)
    {
        $this->rateType = $rateType;
        return $this;
    }
    
    public function getRateDiscountAmount()
    {
        return $this->rateDiscountAmount;
    }
    
    public function setRateDiscountAmount($rateDiscountAmount)
    {
        $this->rateDiscountAmount = $rateDiscountAmount;
        return $this;
    }
    
    public function getRateDiscountType()
    {
        return $this->rateDiscountType;
    }
    
    public function setRateDiscountType($rateDiscountType)
    {
        $this->rateDiscountType = $rateDiscountType;
        return $this;
    }
    
    public function addCriterion(Criterion $criterion)
    {
        $this->criteria[] = $criterion;
    }
    
    public function getCriteria()
    {
        return $this->criteria;
    }
    
    
    public function addFrequencyCap(FrequencyCap $cap)
    {
        $this->frequencyCaps[] = $cap;
    }
    
    public function getFrequencyCaps()
    {
        return $this->frequencyCaps;
    }
    
    public function addCreative(Creative $creative)
    {
        $this->creatives[] = $creative;
    }
    
    public function getCreatives()
    {
        return $this->creatives;
    }
}
