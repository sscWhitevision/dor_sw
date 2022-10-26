<?php
/**
 * @package consentfriend
 * @subpackage plugin
 */

namespace TreehillStudio\ConsentFriend\Plugins\Events;

use TreehillStudio\ConsentFriend\Plugins\Plugin;

class OnManagerPageBeforeRender extends Plugin
{
    public function process()
    {
        if ($this->modx->user && $this->modx->user->hasSessionContext('mgr')) {
            $this->consentfriend->ConsentFriend();
        }
    }
}
