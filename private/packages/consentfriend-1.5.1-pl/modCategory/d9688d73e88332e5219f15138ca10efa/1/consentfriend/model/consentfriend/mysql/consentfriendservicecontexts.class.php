<?php
/**
 * @package consentfriend
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/consentfriendservicecontexts.class.php');
class ConsentfriendServiceContexts_mysql extends ConsentfriendServiceContexts {}
?>