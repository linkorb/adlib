<?php

namespace AdLib\Repository;

use AdLib\Loader\JsonCampaignLoader;

class JsonCampaignRepository
{
    protected $path;
    
    public function __construct($path)
    {
        $this->path = $path;
    }
    
    public function findAll()
    {
        $files = glob($this->path . '/*.json');
        $loader = new JsonCampaignLoader();
        $campaigns = [];
        foreach ($files as $filename) {
            $campaign = $loader->loadFile($filename);
            $id = substr($filename, strlen($this->path)+1, -5); // extract ID from filename
            $campaign->setId($id);
            $campaigns[] = $campaign;
        }
        return $campaigns;
    }
}
