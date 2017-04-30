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
        //$campaign->setMode($data['mode']);
        if (isset($data['width'])) {
            $campaign->setWidth($data['width']);
        }
        if (isset($data['height'])) {
            $campaign->setHeight($data['height']);
        }
        $campaign->setPriority($data['priority']);
        if (isset($data['notes'])) {
            $campaign->setNotes($data['notes']);
        }

        $tz = new DateTimeZone($data['flight']['timezone']);
        //exit($data['flight']['start']);
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

        if (isset($data['criteria'])) {
            foreach ($data['criteria'] as $cdata) {
                $criterion = new Criterion();
                $criterion->setKey($cdata['key']);
                $criterion->setMatch($cdata['operator']);
                $criterion->setValue($cdata['value']);
                $campaign->addCriterion($criterion);
            }
        }

        if (isset($data['frequency-caps'])) {
            foreach ($data['frequency-caps'] as $cdata) {
                $cap = new FrequencyCap();
                $cap->setType($cdata['type']);
                $cap->setImpressions($cdata['impressions']);
                $cap->setSpan($cdata['span']);
                $cap->setUnit($cdata['unit']);
                $campaign->addFrequencyCap($cap);
            }
        }

        if (isset($data['creatives'])) {
            foreach ($data['creatives'] as $cdata) {
                $creative = new Creative();
                $creative->setName($cdata['name']);
                $creative->setType($cdata['type']);
                $creative->setUrl($cdata['url']);
                $creative->setTargetUrl($cdata['targetUrl']);
                $creative->setWeight($cdata['weight']);
                $creative->setWidth($cdata['width']);
                $creative->setHeight($cdata['height']);
                $campaign->addCreative($creative);
            }
        }

        return $campaign;
    }
}
