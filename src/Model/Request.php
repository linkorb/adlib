<?php

namespace AdLib\Model;

use RuntimeException;

class Request
{
    protected $id; // unique request id
    protected $sessionId;
    protected $userId;
    protected $timestamp;

    use PropertyTrait;

    protected $slots = [];

    protected $width;
    protected $height;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

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

    public function addSlot(Slot $slot)
    {
        $slot->setRequest($this);
        $this->slots[] = $slot;
    }

    public function getSlots()
    {
        return $this->slots;
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

    /*
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
    */

}
