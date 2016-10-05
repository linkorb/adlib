<?php

namespace AdLib\Loader;

use AdLib\Model\Zone;
use RuntimeException;

class JsonZoneLoader
{
    public function loadFile($filename)
    {
        $json = file_get_contents($filename);
        $data = json_decode($json, true);
        if (!$data) {
            throw new RuntimeException("Failed to parse json: " . json_last_error_msg());
        }
        return $this->load($data);
    }
    
    public function load($data)
    {
        $zone = new Zone();
        $zone->setName($data['name']);
        if (isset($data['width'])) {
            $zone->setWidth($data['width']);
        }
        if (isset($data['height'])) {
            $zone->setHeight($data['height']);
        }
        if (isset($data['comment'])) {
            $zone->setComment($data['comment']);
        }
        return $zone;
    }
}
