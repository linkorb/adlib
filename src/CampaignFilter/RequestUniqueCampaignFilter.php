<?php

namespace AdLib\CampaignFilter;

use AdLib\Model\Campaign;
use AdLib\Model\Slot;

class RequestUniqueCampaignFilter implements CampaignFilterInterface
{
    public function filter(Campaign $campaign, Slot $slot)
    {
        $request = $slot->getRequest();
        // todo: check if this campaign wants to be unique
        foreach ($request->getSlots() as $slot2) {
            $campaign2 = $slot2->getCampaign();
            if ($campaign2) {
                if ($campaign2->getId()==$campaign->getId()) {
                    return false;
                }
            }
        }
        return true;
    }
}
