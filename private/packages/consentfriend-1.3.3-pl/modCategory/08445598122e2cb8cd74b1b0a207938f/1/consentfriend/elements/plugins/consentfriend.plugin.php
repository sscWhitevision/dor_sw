<?php
/**
 * ConsentFriend Plugin
 *
 * @package consentfriend
 * @subpackage plugin
 *
 * @var modX $modx
 * @var array $scriptProperties
 */

$className = 'TreehillStudio\ConsentFriend\Plugins\Events\\' . $modx->event->name;

$corePath = $modx->getOption('consentfriend.core_path', null, $modx->getOption('core_path') . 'components/consentfriend/');
/** @var ConsentFriend $consentfriend */
$consentfriend = $modx->getService('consentfriend', 'ConsentFriend', $corePath . 'model/consentfriend/', [
    'core_path' => $corePath
]);

if ($consentfriend) {
    if (class_exists($className)) {
        $handler = new $className($modx, $scriptProperties);
        if (get_class($handler) == $className) {
            $handler->run();
        } else {
            $modx->log(xPDO::LOG_LEVEL_ERROR, $className. ' could not be initialized!', '', 'ConsentFriend Plugin');
        }
    } else {
        $modx->log(xPDO::LOG_LEVEL_ERROR, $className. ' was not found!', '', 'ConsentFriend Plugin');
    }
}

return;