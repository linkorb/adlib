<?php

use AdLib\Model\Network;
use AdLib\Model\Request;
use AdLib\Model\Response;
use AdLib\Model\Zone;
use AdLib\Model\Slot;
use AdLib\CampaignSelector\RandomCampaignSelector;
use AdLib\CreativeSelector\RandomCreativeSelector;
use AdLib\CampaignFilter\FlightCampaignFilter;
use AdLib\CampaignFilter\SizeCampaignFilter;
use AdLib\CampaignFilter\RequestUniqueCampaignFilter;
use AdLib\CampaignFilter\PropertyCampaignFilter;
use AdLib\CampaignFilter\FrequencyCapCampaignFilter;
use AdLib\CampaignFilter\ImpressionCampaignFilter;
use AdLib\Repository\JsonCampaignRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$network = new Network();
$network->setName('Example Corp');
$impressionRepo = new \AdLib\Repository\ArrayImpressionRepository();
$impressionRepo->setImpressionsPerCampaign(
    [
        'Leaderboard 1 320x50' => 100,
        'Leaderboard 2 320x50' => 50,
    ]
);

$zone1 = new Zone();
$zone1->setId('zone-1');
$zone1->setName("Zone one");
$zone1->setWidth(320);
$zone1->setHeight(50);
$network->addZone($zone1);

$zone2 = new Zone();
$zone2->setId('zone-2');
$zone2->setName("Zone two");
$zone2->setWidth(320);
$zone2->setHeight(50);
$network->addZone($zone2);



$campaignRepo = new JsonCampaignRepository(__DIR__ . '/campaigns');
$campaigns = $campaignRepo->findAll();
foreach ($campaigns as $campaign) {
    $network->addCampaign($campaign);
}

$request = new Request();
$request->setSessionId(1);
$request->setTimestamp(time());
$request->setProperty('browser.name', 'chrome');
$request->setProperty('profile.gender', 'f');
$request->setProperty('profile.age', '25');
/*
$request->setWidth(320);
$request->setHeight(50);
*/

$slot = new Slot();
$slot->setZone($zone1);
$request->addSlot($slot);

$slot = new Slot();
$slot->setZone($zone2);
$request->addSlot($slot);

$campaigns = $network->getCampaigns();

$network->addCampaignFilter(new FlightCampaignFilter());
$network->addCampaignFilter(new SizeCampaignFilter());
$network->addCampaignFilter(new PropertyCampaignFilter());
$network->addCampaignFilter(new RequestUniqueCampaignFilter());

$network->addCampaignFilter(new ImpressionCampaignFilter($impressionRepo));
$network->addCampaignFilter(new FrequencyCapCampaignFilter($impressionRepo));

$network->setCampaignSelector(new RandomCampaignSelector());
$network->setCreativeSelector(new RandomCreativeSelector());

$network->resolve($request);

foreach ($request->getSlots() as $slot) {
    echo "=== SLOT === Zone: " . $slot->getZone()->getId() . "\n";
    $excludes = $slot->getExcludes();
    echo "Excludes: " . count($excludes) . "\n";
    foreach ($excludes as $exclude) {
        $campaign = $exclude->getCampaign();
        echo " * ID-" . $campaign->getId() . ': ' . $campaign->getName() . " by " . $exclude->getFilter() . "\n";
    }

    $candidates = $slot->getCandidates();
    echo "Candidates: " . count($candidates) . "\n";
    foreach ($candidates as $campaign) {
        echo " * ID-" . $campaign->getId() . ': ' . $campaign->getName() . " [P" . $campaign->getPriority() . "]\n";
    }

    $campaign = $slot->getCampaign();
    if (!$campaign) {
        echo "No campaign found\n";
    } else {
        $creative = $slot->getCreative();

        echo "Campaign: " . $campaign->getId() . ': ' . $campaign->getName() . "\n";
        echo "Creative: " . $creative->getName() . "\n";
    }
}
//print_r($campaign);
exit();
