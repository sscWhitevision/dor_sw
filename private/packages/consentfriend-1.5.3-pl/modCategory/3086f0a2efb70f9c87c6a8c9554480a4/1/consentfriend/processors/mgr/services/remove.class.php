<?php
/**
 * Remove Service
 *
 * @package consentfriend
 * @subpackage processors
 */

use TreehillStudio\ConsentFriend\Processors\ObjectRemoveProcessor;

class ConsentFriendServicesRemoveProcessor extends ObjectRemoveProcessor
{
    public $classKey = 'ConsentfriendServices';
    public $objectType = 'consentfriend.services';
}

return 'ConsentFriendServicesRemoveProcessor';
