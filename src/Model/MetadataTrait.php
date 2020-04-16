<?php
namespace AdLib\Model;

trait MetadataTrait {

    protected $metadata = [];

    public function setMetadataValue($name, $value)
    {
        $this->metadata[$name] = $value;
    }

    public function hasMetadataValue($name)
    {
        return isset($this->metadata[$name]);
    }

    public function getMetadataValue($name)
    {
        if (!$this->hasMetadataValue($name)) {
            throw new RuntimeException("Undefined metadata: " . $name);
        }

        return $this->metadata[$name];
    }

    public function getMetadata(): array
    {
        return $this->metadata;
    }
}
