<?php
$modx->lexicon->load('redactor:default', 'redactor:configuration');
$lang = $modx->lexicon->fetch();
$modx->smarty->assign('_lang',$lang);


$corePath = $modx->getOption('redactor.core_path', null, $modx->getOption('core_path').'components/redactor/');
$redactor = $modx->getService('redactor', 'Redactor', $corePath . 'model/redactor/');
if (!($redactor instanceof Redactor)) {
    $modx->log(modX::LOG_LEVEL_ERROR, '[Redactor] Error loading Redactor service class from ' . $corePath);
    return 'Unable to load Redactor service class';
}

$sets = [];
$c = $modx->newQuery('redConfigurationSet');
$c->sortby('name', 'ASC');
foreach ($modx->getIterator('redConfigurationSet', $c) as $set) {
    $sets[ $set->get('id') ] = $set->get('name');
}
$modx->smarty->assign('configSets', $sets);

return $modx->smarty->fetch($corePath.'elements/tvs/tpl/inputproperties.tpl');
