<?php

namespace AdLib\CampaignFilter;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use AdLib\Model\Campaign;
use AdLib\Model\Slot;

class ExpressionCampaignFilter implements CampaignFilterInterface
{
    public function __construct()
    {
        $this->expressionLanguage = new ExpressionLanguage();
    }
    public function filter(Campaign $campaign, Slot $slot)
    {
        $request = $slot->getRequest();
        $stamp = $request->getTimestamp();

        
        // If no expression is defined, accept the campaign
        if (!$campaign->getExpression()) {
            return true;
        }
        
        $data = [];
        foreach ($request->getProperties() as $k=>$v) {
            $k = str_replace('.', '__', $k);
            $data[$k] = $v;
        }
        $data['date'] = date('Ymd');
        // print_r($data);exit();
        $data['request'] = $request;

        $expression = $campaign->getExpression();
        try {
            $res = $this->expressionLanguage->evaluate(
                $expression,
                $data
            );
        } catch (\Exception $e) {
            // on error, don't show the campaign
            return false; 
            // throw $e; // rethrow if debugging
        }
        return $res;
    }
}
