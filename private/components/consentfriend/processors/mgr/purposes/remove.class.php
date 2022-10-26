<?php
/**
 * Remove Purpose
 *
 * @package consentfriend
 * @subpackage processors
 */

use TreehillStudio\ConsentFriend\Processors\ObjectRemoveProcessor;

class ConsentFriendPurposesRemoveProcessor extends ObjectRemoveProcessor
{
    public $classKey = 'ConsentfriendPurposes';
    public $objectType = 'consentfriend.purposes';
}

return 'ConsentFriendPurposesRemoveProcessor';
