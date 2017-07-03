<?php

namespace AdLib\Model;

use RuntimeException;

class Request
{
    protected $id; // unique request id
    protected $sessionId;
    protected $userId;
    protected $timestamp;
    protected $slots = [];
    protected $categories = [];

    use PropertyTrait;



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

    public function setCategory($category, $exclusivity)
    {
        if (!$category) {
            return;
        }
        $this->categories[$category] = strtoupper($exclusivity);
    }

    public function isCategoryAvailable($category)
    {
        if (!$category) {
            return true; // no category always allowed
        }

        foreach ($this->categories as $key=>$value) {
            if ($key==$category) {
                if ($value=='Y') {
                    // exclusive category used
                    return false;
                }
            }
        }
        return true; // available
    }

}
