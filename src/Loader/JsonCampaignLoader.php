<?php

namespace AdLib\Loader;

use AdLib\Model\Campaign;
use AdLib\Model\Criterion;
use AdLib\Model\FrequencyCap;
use AdLib\Model\Creative;
use DateTime;
use DateTimeZone;

use RuntimeException;

class JsonCampaignLoader
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
        $campaign = new Campaign();
        $campaign->setName($data['name']);
        $campaign->setMode($data['mode']);
        $campaign->setWidth($data['width']);
        $campaign->setHeight($data['height']);
        $campaign->setPriority($data['priority']);
        $campaign->setComment($data['comment']);
        
        $tz = new DateTimeZone($data['flight']['timezone']);
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $data['flight']['start'], $tz);
        $campaign->setFlightStart($date->getTimestamp());
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $data['flight']['end'], $tz);
        $campaign->setFlightEnd($date->getTimestamp());
        $campaign->setFlightTimezone($data['flight']['timezone']);
        
        $campaign->setGoalQuantity($data['goal']['quantity']);
        $campaign->setGoalType($data['goal']['type']);
        $campaign->setGoalMode($data['goal']['mode']);
        
        $campaign->setRatePrice($data['rate']['price']);
        $campaign->setRateCurrency($data['rate']['currency']);
        $campaign->setRateType($data['rate']['type']);
        
        $campaign->setRateDiscountAmount($data['rate']['discount']['amount']);
        $campaign->setRateDiscountType($data['rate']['discount']['type']);
        
        foreach ($data['criteria'] as $cdata) {
            $criterion = new Criterion();
            $criterion->setKey($cdata['key']);
            $criterion->setMatch($cdata['match']);
            $criterion->setValue($cdata['value']);
            $campaign->addCriterion($criterion);
        }
        
        foreach ($data['frequency-caps'] as $cdata) {
            $cap = new FrequencyCap();
            $cap->setType($cdata['type']);
            $cap->setImpressions($cdata['impressions']);
            $cap->setSpan($cdata['span']);
            $cap->setUnit($cdata['unit']);
            $campaign->addFrequencyCap($cap);
        }
        
        foreach ($data['creatives'] as $cdata) {
            $creative = new Creative();
            $creative->setName($cdata['name']);
            $creative->setType($cdata['type']);
            $creative->setUrl($cdata['url']);
            $creative->setTarget($cdata['target']);
            $creative->setWeight($cdata['weight']);
            $creative->setWidth($cdata['width']);
            $creative->setHeight($cdata['height']);
            $campaign->addCreative($creative);
        }
        
        return $campaign;
    }
}
