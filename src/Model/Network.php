<?php

namespace AdLib\Model;

use AdLib\CampaignFilter\CampaignFilterInterface;
use AdLib\CampaignSelector\CampaignSelectorInterface;
use AdLib\CreativeSelector\CreativeSelectorInterface;

class Network
{
    protected $name;
    protected $campaigns = [];
    protected $filters = [];
    protected $campaignSelector;
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    public function addCampaign(Campaign $campaign)
    {
        $this->campaigns[] = $campaign;
    }
    
    public function getCampaigns()
    {
        return $this->campaigns;
    }
    
    public function addCampaignFilter(CampaignFilterInterface $campaignFilter)
    {
        $this->campaignFilters[] = $campaignFilter;
    }
    
    public function getCampaignFilters()
    {
        return $this->campaignFilters;
    }
    
    public function setCampaignSelector(CampaignSelectorInterface $campaignSelector)
    {
        $this->campaignSelector = $campaignSelector;
    }
    
    public function setCreativeSelector(CreativeSelectorInterface $creativeSelector)
    {
        $this->creativeSelector = $creativeSelector;
    }
    
    public function process(Request $request)
    {
        $response = new Response();

        foreach ($this->campaigns as $campaign) {
            $include = true;
            foreach ($this->campaignFilters as $campaignFilter) {
                if ($include) {
                    if (!$campaignFilter->filter($campaign, $request)) {
                        $exclude = new Exclude();
                        $exclude->setCampaign($campaign);
                        $exclude->setFilter(get_class($campaignFilter));
                        $response->addExclude($exclude);
                        $include = false;
                    }
                }
            }
            if ($include) {
                $response->addCandidate($campaign);
            }
        }
        
        $campaign = $this->campaignSelector->select($response->getCandidates());
        if ($campaign) {
            $response->setCampaign($campaign);
            $response->setCreative($this->creativeSelector->select($campaign));
        }
        
        return $response;
    }
}
