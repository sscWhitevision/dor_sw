<?php
/**
 * @package consentfriend
 * @subpackage plugin
 */

namespace TreehillStudio\ConsentFriend\Plugins\Events;

use TreehillStudio\ConsentFriend\Plugins\Plugin;

class OnHandleRequest extends Plugin
{
    public function process()
    {
        if ($this->modx->context->get('key') != 'mgr' && MODX_API_MODE == false && $this->consentfriend->getOption('enable')) {
            $this->consentfriend->addServices();
        }
    }
}
