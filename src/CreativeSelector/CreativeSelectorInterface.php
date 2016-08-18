<?php

namespace AdLib\CreativeSelector;

use AdLib\Model\Campaign;

interface CreativeSelectorInterface
{
    public function select(Campaign $campaign);
}
