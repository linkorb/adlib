<?php

namespace AdLib\Model;

use AdLib\CampaignFilter\CampaignFilterInterface;
use AdLib\CampaignSelector\CampaignSelectorInterface;
use AdLib\CreativeSelector\CreativeSelectorInterface;
use AdLib\Model\Zone;
use RuntimeException;

class Network
{
    protected $name;
    protected $campaigns = [];
    protected $zones = [];
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

    public function addZone(Zone $zone)
    {
        $this->zones[$zone->getId()] = $zone;
    }

    public function getZones()
    {
        return $this->zones;
    }

    public function hasZone($id)
    {
        return isset($this->zones[$id]);
    }

    public function getZone($id)
    {
        if (!$this->hasZone($id)) {
            throw new RuntimeException("No such zone id: " . $id);
        }
        return $this->zones[$id];
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

    public function resolve(Request $request)
    {
        foreach ($request->getSlots() as $slot) {
            foreach ($this->campaigns as $campaign) {
                $include = true;
                foreach ($this->campaignFilters as $campaignFilter) {
                    if ($include) {
                        if (!$campaignFilter->filter($campaign, $slot)) {
                            $exclude = new Exclude();
                            $exclude->setCampaign($campaign);
                            $exclude->setFilter(get_class($campaignFilter));
                            $slot->addExclude($exclude);
                            $include = false;
                        }
                    }
                }
                if ($include) {
                    $slot->addCandidate($campaign);
                }
            }

            $campaign = $this->campaignSelector->select($slot->getCandidates());
            if ($campaign) {
                $slot->setCampaign($campaign);
                $slot->setCreative($this->creativeSelector->select($campaign));
            }
        }
    }
}
