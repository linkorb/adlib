<?php
namespace AdLib\Model;

class Slot
{
    protected $id;
    protected $zone;
    protected $request;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }
    public function getRequest()
    {
        return $this->request;
    }

    public function setZone(Zone $zone)
    {
        $this->zone = $zone;
    }

    public function getZone()
    {
        return $this->zone;
    }


    private $candidates = [];
    private $excludes = [];
    private $campaign;
    private $creative;

    public function getCampaign()
    {
        return $this->campaign;
    }

    public function setCampaign($campaign)
    {
        $this->campaign = $campaign;
        return $this;
    }

    public function getCreative()
    {
        return $this->creative;
    }

    public function setCreative(Creative $creative)
    {
        $this->creative = $creative;
        return $this;
    }

    public function addCandidate(Campaign $campaign)
    {
        $this->candidates[] = $campaign;
    }

    public function prioritySort($a, $b)
    {
        return $a->getPriority() > $b->getPriority();
    }

    public function getCandidates()
    {
        usort($this->candidates, [$this, 'prioritySort']);
        return $this->candidates;
    }

    public function addExclude(Exclude $exclude)
    {
        $this->excludes[] = $exclude;
    }

    public function getExcludes()
    {
        return $this->excludes;
    }
}
