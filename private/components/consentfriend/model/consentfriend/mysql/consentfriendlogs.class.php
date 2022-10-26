<?php
/**
 * @package consentfriend
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/consentfriendlogs.class.php');
class ConsentfriendLogs_mysql extends ConsentfriendLogs {}
?>