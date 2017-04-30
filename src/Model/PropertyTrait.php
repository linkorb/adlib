<?php
namespace Adlib\Model;

trait PropertyTrait {

    protected $properties;

    public function setProperty($name, $value)
    {
        $this->properties[$name] = $value;
    }

    public function hasProperty($name)
    {
        return isset($this->properties[$name]);
    }

    public function getProperty($name)
    {
        if (!$this->hasProperty($name)) {
            throw new RuntimeException("Undefined property: " . $name);
        }

        return $this->properties[$name];
    }

    public function getProperties()
    {
        return $this->properties;
    }
}
