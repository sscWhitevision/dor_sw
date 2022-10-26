<?php
/**
 * @package consentfriend
 * @subpackage plugin
 */

namespace TreehillStudio\ConsentFriend\Plugins\Events;

use TreehillStudio\ConsentFriend\Plugins\Plugin;

class OnWebPagePrerender extends Plugin
{
    /**
     * {@inheritDoc}
     * @return bool
     */
    public function init()
    {
        return $this->isEnabled();
    }

    /**
     * {@inheritDoc}
     * @return void
     */
    public function process()
    {
        if ($this->consentfriend->getOption('enable')) {
            $this->consentfriend->addConsentFriend();
            if ($this->consentfriend->getOption('logUsage')) {
                $this->consentfriend->logUsage();
            }
        }
    }
}
