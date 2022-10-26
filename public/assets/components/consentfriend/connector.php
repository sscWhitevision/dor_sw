<?php
/**
 * ConsentFriend connector
 *
 * @package consentfriend
 * @subpackage connector
 *
 * @var modX $modx
 */

require_once dirname(__FILE__, 4) . '/config.core.php';
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
require_once MODX_CONNECTORS_PATH . 'index.php';

$corePath = $modx->getOption('consentfriend.core_path', null, $modx->getOption('core_path') . 'components/consentfriend/');
/** @var ConsentFriend $consentfriend */
$consentfriend = $modx->getService('consentfriend', 'ConsentFriend', $corePath . 'model/consentfriend/', [
    'core_path' => $corePath
]);

// Handle request
$modx->request->handleRequest([
    'processors_path' => $consentfriend->getOption('processorsPath'),
    'location' => ''
]);
