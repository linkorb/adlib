<?php

namespace AdLib\Model;

class Criterion
{
    protected $type; // zone, browser, profile, ...
    protected $key;
    protected $match; // 'equals', 'not-equals', 'greater than'
    protected $value;
    
    public function getType()
    {
        return $this->type;
    }
    
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    
    public function getKey()
    {
        return $this->key;
    }
    
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }
    
    public function getMatch()
    {
        return $this->match;
    }
    
    public function setMatch($match)
    {
        $this->match = $match;
        return $this;
    }
    
    public function getValue()
    {
        return $this->value;
    }
    
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}
