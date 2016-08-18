<?php

namespace AdLib\Model;

use RuntimeException;

class Request
{
    protected $sessionId;
    protected $userId;
    protected $timestamp;
    protected $keys = [];
    protected $width;
    protected $height;
    
    public function getSessionId()
    {
        return $this->sessionId;
    }
    
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
        return $this;
    }
    
    public function getUserId()
    {
        return $this->userId;
    }
    
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }
    
    public function getTimestamp()
    {
        return $this->timestamp;
    }
    
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
        return $this;
    }
    
    
    public function hasKey($key)
    {
        return isset($this->keys[$key]);
    }
    
    public function getKey($key)
    {
        if (!$this->hasKey($key)) {
            throw new RuntimeException('No such key: ' . $key);
        }
        return $this->keys[$key];
    }
    
    public function setKey($key, $value)
    {
        $this->keys[$key] = $value;
        return $this;
    }
    
    public function getKeys()
    {
        return $this->keys;
    }
    
    public function getWidth()
    {
        return $this->width;
    }
    
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }
    
    public function getHeight()
    {
        return $this->height;
    }
    
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }
}
