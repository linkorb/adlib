<?php

require_once __DIR__ . '/../vendor/autoload.php';

echo "yo\n";

$l = new \AdLib\Loader\JsonCampaignLoader();
$campaign = $l->loadFile(__DIR__ . '/campaign-1.json');

print_r($campaign);
exit();
