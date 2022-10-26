<?php
/**
 * ConsentFriend Connector
 *
 * @package consentfriend
 * @subpackage connector
 *
 * @var modX $modx
 */

$web = 'web/';
// Allow anonymous users for web processors and restrict actions to that folder including subfolders with restricted chars
if (isset($_REQUEST['action']) && strpos($_REQUEST['action'], $web) === 0) {
    $_REQUEST['action'] = $web . preg_replace('#[^a-z0-9/_-]#i', '', substr($_REQUEST['action'], strlen($web)));
    define('MODX_REQP', false);
}

require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
require_once MODX_CONNECTORS_PATH . 'index.php';

$corePath = $modx->getOption('consentfriend.core_path', null, $modx->getOption('core_path') . 'components/consentfriend/');
/** @var ConsentFriend $consentfriend */
$consentfriend = $modx->getService('consentfriend', 'ConsentFriend', $corePath . 'model/consentfriend/', [
    'core_path' => $corePath
]);

// Set HTTP_MODAUTH for web processors
if (defined('MODX_REQP') && MODX_REQP === false) {
    $_SERVER['HTTP_MODAUTH'] = $modx->user->getUserToken($modx->context->get('key'));
}

// Handle request
$modx->request->handleRequest([
    'processors_path' => $consentfriend->getOption('processorsPath'),
    'location' => ''
]);
