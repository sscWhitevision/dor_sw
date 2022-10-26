<?php
/**
 * Remove processor
 *
 * @package consentfriend
 * @subpackage processor
 */

use TreehillStudio\ConsentFriend\Processors\ObjectRemoveProcessor;

class ConsentFriendServicesRemoveProcessor extends ObjectRemoveProcessor
{
    public $classKey = 'ConsentfriendServices';
    public $objectType = 'consentfriend.services';
}

return 'ConsentFriendServicesRemoveProcessor';
