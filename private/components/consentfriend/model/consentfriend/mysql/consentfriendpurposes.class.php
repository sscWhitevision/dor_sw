<?php
/**
 * @package consentfriend
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/consentfriendpurposes.class.php');
class ConsentfriendPurposes_mysql extends ConsentfriendPurposes {}
?>