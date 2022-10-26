<?php
/**
 * Image+ Output Options Render
 *
 * @package imageplus
 * @subpackage outputoptions_render
 */

/** @var \modX $modx */
$corePath = $modx->getOption('imageplus.core_path', null, $modx->getOption('core_path') . 'components/imageplus/');
/** @var ImagePlus $imageplus */
$imageplus = $modx->getService('imageplus', 'ImagePlus', $corePath . 'model/imageplus/', [
    'core_path' => $corePath
]);

return $modx->smarty->fetch($corePath . 'elements/tv/output/tpl/imageplus.options.tpl');
