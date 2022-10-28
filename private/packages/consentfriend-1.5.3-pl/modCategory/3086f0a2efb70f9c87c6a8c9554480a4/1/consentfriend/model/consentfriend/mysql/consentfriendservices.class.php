<?php
/**
 * @package consentfriend
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/consentfriendservices.class.php');
class ConsentfriendServices_mysql extends ConsentfriendServices {}
?>