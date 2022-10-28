<?php
/**
 * @package consentfriend
 * @subpackage plugin
 */

namespace TreehillStudio\ConsentFriend\Plugins\Events;

use TreehillStudio\ConsentFriend\Plugins\Plugin;
use xPDO;

class OnSiteRefresh extends Plugin
{
    public function process()
    {
        $this->modx->cacheManager->clean($this->consentfriend->cacheOptions);
        $this->modx->log(xPDO::LOG_LEVEL_INFO, $this->modx->lexicon('consentfriend.refresh_cache', ['packagename' => $this->consentfriend->packageName]));
    }
}
