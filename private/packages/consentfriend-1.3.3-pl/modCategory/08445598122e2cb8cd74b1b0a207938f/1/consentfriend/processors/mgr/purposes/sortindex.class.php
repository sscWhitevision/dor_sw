<?php
/**
 * Sortindex purposes
 *
 * @package consentfriend
 * @subpackage processor
 */

use TreehillStudio\ConsentFriend\Processors\ObjectSortindexProcessor;

/**
 * Class ConsentfriendPurposesSortindexProcessor
 */
class ConsentfriendPurposesSortindexProcessor extends ObjectSortindexProcessor
{
    public $classKey = 'ConsentfriendPurposes';
    public $objectType = 'consentfriend.purposes';
}

return 'ConsentfriendPurposesSortindexProcessor';
