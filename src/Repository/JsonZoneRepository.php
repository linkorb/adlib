<?php

namespace AdLib\Repository;

use AdLib\Loader\JsonZoneLoader;

class JsonZoneRepository
{
    protected $path;
    
    public function __construct($path)
    {
        $this->path = $path;
    }
    
    public function findAll()
    {
        $files = glob($this->path . '/*.json');
        $loader = new JsonZoneLoader();
        $campaigns = [];
        foreach ($files as $filename) {
            $zone = $loader->loadFile($filename);
            //$id = substr($filename, strlen($this->path)+1, -5); // extract ID from filename
            $id = $zone->getName();
            $zone->setId($id);
            $zones[] = $zone;
        }
        return $zones;
    }
}
