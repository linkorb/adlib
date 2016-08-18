<?php

use AdLib\Model\Network;
use AdLib\Model\Request;
use AdLib\Model\Response;
use AdLib\CampaignSelector\RandomCampaignSelector;
use AdLib\CreativeSelector\RandomCreativeSelector;
use AdLib\CampaignFilter\FlightCampaignFilter;
use AdLib\CampaignFilter\SizeCampaignFilter;
use AdLib\CampaignFilter\KeyValueCampaignFilter;
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
$campaignRepo = new JsonCampaignRepository(__DIR__ . '/campaigns');
$campaigns = $campaignRepo->findAll();
foreach ($campaigns as $campaign) {
    $network->addCampaign($campaign);
}

$request = new Request();
$request->setSessionId(1);
$request->setTimestamp(time());
$request->setKey('browser.name', 'chrome');
$request->setKey('profile.gender', 'f');
$request->setKey('profile.age', '25');
$request->setWidth(320);
$request->setHeight(50);


$campaigns = $network->getCampaigns();

$network->addCampaignFilter(new FlightCampaignFilter());
$network->addCampaignFilter(new SizeCampaignFilter());
$network->addCampaignFilter(new KeyValueCampaignFilter());
$network->addCampaignFilter(new ImpressionCampaignFilter($impressionRepo));
$network->addCampaignFilter(new FrequencyCapCampaignFilter($impressionRepo));
$network->setCampaignSelector(new RandomCampaignSelector());
$network->setCreativeSelector(new RandomCreativeSelector());

$response = $network->process($request);

$excludes = $response->getExcludes();
echo "Excludes: " . count($excludes) . "\n";
foreach ($excludes as $exclude) {
    $campaign = $exclude->getCampaign();
    echo " * ID-" . $campaign->getId() . ': ' . $campaign->getName() . " by " . $exclude->getFilter() . "\n";
}

$candidates = $response->getCandidates();
echo "Candidates: " . count($candidates) . "\n";
foreach ($candidates as $campaign) {
    echo " * ID-" . $campaign->getId() . ': ' . $campaign->getName() . " [P" . $campaign->getPriority() . "]\n";
}

$campaign = $response->getCampaign();
if (!$campaign) {
    echo "No campaign found\n";
} else {
    $creative = $response->getCreative();

    echo "Campaign: " . $campaign->getId() . ': ' . $campaign->getName() . "\n";
    echo "Creative: " . $creative->getName() . "\n";
}

//print_r($campaign);
exit();
