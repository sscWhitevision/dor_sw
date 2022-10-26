<?php
/**
 * @package consentfriend
 * @subpackage plugin
 */

namespace TreehillStudio\ConsentFriend\Plugins\Events;

use TreehillStudio\ConsentFriend\Plugins\Plugin;

class OnWebPagePrerender extends Plugin
{
    public function process()
    {
        if ($this->consentfriend->getOption('enable')) {
            $this->consentfriend->addConsentFriend();
        }
    }
}
