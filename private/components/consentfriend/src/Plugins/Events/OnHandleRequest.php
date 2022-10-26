<?php
/**
 * @package consentfriend
 * @subpackage plugin
 */

namespace TreehillStudio\ConsentFriend\Plugins\Events;

use TreehillStudio\ConsentFriend\Plugins\Plugin;

class OnHandleRequest extends Plugin
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
        if ($this->modx->context->get('key') != 'mgr' &&
            (!defined('MODX_API_MODE') || !MODX_API_MODE) &&
            $this->consentfriend->getOption('enable')) {
            $this->consentfriend->addServices();
        }
    }
}
