<?php
/**
 * Remove processor
 *
 * @package consentfriend
 * @subpackage processor
 */

use TreehillStudio\ConsentFriend\Processors\ObjectRemoveProcessor;

class ConsentFriendPurposesRemoveProcessor extends ObjectRemoveProcessor
{
    public $classKey = 'ConsentfriendPurposes';
    public $objectType = 'consentfriend.purposes';
}

return 'ConsentFriendPurposesRemoveProcessor';
