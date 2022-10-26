<?php
/**
 * Site connector
 *
 * @package site
 * @subpackage connector
 *
 * @var modX $modx
 */

define('MODX_REQP', false); // for web ajax requests

require_once dirname(dirname(dirname(dirname(__FILE__)))).'/config.core.php';
require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
require_once MODX_CONNECTORS_PATH . 'index.php';

$corePath = $modx->getOption('site.core_path',null,$modx->getOption('core_path').'components/site/');

// Set HTTP_MODAUTH for web ajax processors
if (defined('MODX_REQP') && MODX_REQP === false) {
    $_SERVER['HTTP_MODAUTH'] = $modx->user->getUserToken('mgr');
}

/* handle request */
$modx->request->handleRequest(array(
    'processors_path' => $corePath . 'processors/',
    'location' => ''
));
