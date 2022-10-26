<?php
/**
 * This file contains the option definitions for Redactor, including rules on normalising values.
 *
 * For third party usage, do not include this file directly. Rather, use Redactor::getOptions() or Redactor::getOptionGroups().
 *
 * @var modX $modx
 * @var Redactor $redactor
 */
// @todo Add to an autoloader instead
use modmore\Redactor\Group;
use modmore\Redactor\Setting;

require_once __DIR__ . '/src/Group.php';
require_once __DIR__ . '/src/Setting.php';

$options = [];


$toolbar = new Group('toolbar');
$toolbar
    ->addSetting(new Setting('buttons', 'format, bold, italic, underline, divider, table, link, image, file, divider, ol, ul, indent, outdent, divider, redo, undo, divider, html', 'textarea', Setting::castToArray()))
//    ->addSetting(new Setting('buttonsAddFirst', '', 'textfield', Setting::castToArray()))
//    ->addSetting(new Setting('buttonsAddBefore', '', 'textfield', Setting::stringToArray()))
//    ->addSetting(new Setting('buttonsAddAfter', '', 'textfield', Setting::stringToArray()))
    ->addSetting(new Setting('buttonsTextLabeled', false, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('air', false, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('toolbar', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('toolbarContext', true, 'checkbox', Setting::castToBool()));
$options[] = $toolbar;

$appearance = new Group('appearance');
$appearance
//    ->addSetting(new Setting('lang', '', 'textfield'))
    ->addSetting(new Setting('theme', 'default', 'textfield'))
    ->addSetting(new Setting('minHeight', 200, 'numberfield', Setting::castToPixelOrFalse()))
    ->addSetting(new Setting('maxHeight', false, 'numberfield', Setting::castToPixelOrFalse()))
    ->addSetting(new Setting('maxWidth', false, 'numberfield', Setting::castToPixelOrFalse()))
    ->addSetting(new Setting('animation', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('structure', false, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('structureTheme', false, 'redactor-combo-structuretheme'))
    ->addSetting(new Setting('counter', false, 'checkbox', Setting::castToBool()))
//    ->addSetting(new Setting('styles', true, 'checkbox'))
    ->addSetting(new Setting('direction', 'ltr', 'redactor-combo-editor-direction'))
    ->addSetting(new Setting('stylesClass', 'redactor-styles', 'textfield'));
$options[] = $appearance;

$clean = new Group('clean');
$clean
    ->addSetting(new Setting('cleanOnEnter', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('cleanInlineOnEnter', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('removeScript', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('removeNewLines', false, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('removeComments', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('pasteClean', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('pastePlainText', false, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('pasteImages', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('pasteLinks', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('pasteLinkTarget', false, 'textfield', Setting::castToStringOrFalse()))
    ->addSetting(new Setting('pasteBlockTags', 'pre,h1,h2,h3,h4,h5,h6,table,tbody,thead,tfoot,th,tr,td,ul,ol,li,blockquote,p,figure,figcaption', 'textfield', Setting::castToArray()))
    ->addSetting(new Setting('pasteInlineTags', 'a,img,br,strong,ins,code,del,span,samp,kbd,sup,sub,mark,var,cite,small,b,u,em,i', 'textfield', Setting::castToArray()))
    ->addSetting(new Setting('pasteKeepStyle', '', 'textfield', Setting::castToArray()))
    ->addSetting(new Setting('pasteKeepClass', '', 'textfield', Setting::castToArray()))
    ->addSetting(new Setting('pasteKeepAttrs', '', 'textfield', Setting::castToArray()))
;
// @todo $clean->addSetting(new Setting('replaceTags', [], 'checkbox'));
$options[] = $clean;

$formatting = new Group('formatting');
$formatting
    ->addSetting(new Setting('markup', 'p'))
    ->addSetting(new Setting('enterKey', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('breakline', false, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('formatting', 'p,blockquote,pre,h1,h2,h3,h4,h5,h6', 'textarea', Setting::castToArray()))
    ->addSetting(new Setting('formattingAdd', '', 'textarea', Setting::castJSONToObject()))
    ->addSetting(new Setting('preClass', false, 'textfield', Setting::castToStringOrFalse()))
    ->addSetting(new Setting('preSpaces', 4, 'numberfield', Setting::castToIntOrFalse()))
    ->addSetting(new Setting('tabAsSpaces', false, 'numberfield', Setting::castToIntOrFalse()))
    ->addSetting(new Setting('fontcolors', implode(',', [
        '#ffffff', '#000000', '#eeece1', '#1f497d', '#4f81bd', '#c0504d', '#9bbb59', '#8064a2', '#4bacc6', '#f79646', '#ffff00',
        '#f2f2f2', '#7f7f7f', '#ddd9c3', '#c6d9f0', '#dbe5f1', '#f2dcdb', '#ebf1dd', '#e5e0ec', '#dbeef3', '#fdeada', '#fff2ca',
        '#d8d8d8', '#595959', '#c4bd97', '#8db3e2', '#b8cce4', '#e5b9b7', '#d7e3bc', '#ccc1d9', '#b7dde8', '#fbd5b5', '#ffe694',
        '#bfbfbf', '#3f3f3f', '#938953', '#548dd4', '#95b3d7', '#d99694', '#c3d69b', '#b2a2c7', '#b7dde8', '#fac08f', '#f2c314',
        '#a5a5a5', '#262626', '#494429', '#17365d', '#366092', '#953734', '#76923c', '#5f497a', '#92cddc', '#e36c09', '#c09100',
        '#7f7f7f', '#0c0c0c', '#1d1b10', '#0f243e', '#244061', '#632423', '#4f6128', '#3f3151', '#31859b',  '#974806', '#7f6000'
    ]), 'textarea', Setting::castToArray()))
    ->addSetting(new Setting('fontfamily', implode(',', ['Arial', 'Helvetica', 'Georgia', 'Times New Roman', 'Monospace']), 'textarea', Setting::castToArray()));
$options[] = $formatting;


$media = new Group('media');
$media
    ->addSetting(new Setting('imageFigure', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('imageCaption', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('imagePosition', false, 'checkbox', Setting::castToBool())) // @todo add interface for object class definitions
    ->addSetting(new Setting('imageFloatMargin', '10px', 'textfield'))
    ->addSetting(new Setting('imageEditable', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('imageStyles', true, 'textarea', Setting::castJSONToObject()))
    ->addSetting(new Setting('imageResizable', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('baseurlsMode', 'relative', 'redactor-combo-baseurlmode'));
$options[] = $media;

$uploads = new Group('media_uploads');
$uploads
    ->addSetting(new Setting('imageUploadSource', $modx->getOption('default_media_source'), 'modx-combo-source', Setting::castToIntOrFalse()))
    ->addSetting(new Setting('imageUploadPath', 'assets/uploads/', 'textfield'))
    ->addSetting(new Setting('fileUploadSource', $modx->getOption('default_media_source'), 'modx-combo-source', Setting::castToIntOrFalse()))
    ->addSetting(new Setting('fileUploadPath', 'assets/uploads/', 'textfield'))
    ->addSetting(new Setting('uploadCleanFilenames', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('uploadIncrementFilenames', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('dragUpload', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('clipboardUpload', true, 'checkbox', Setting::castToBool()));
$options[] = $uploads;

$simpleBrowser = new Group('media_simplebrowser');
$simpleBrowser
    ->addSetting(new Setting('imageSimpleBrowser', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('imageSimpleBrowserSource', $modx->getOption('default_media_source'), 'modx-combo-source', Setting::castToIntOrFalse()))
    ->addSetting(new Setting('imageSimpleBrowserPath', '/', 'textfield'))

    ->addSetting(new Setting('fileSimpleBrowser', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('fileSimpleBrowserSource', $modx->getOption('default_media_source'), 'modx-combo-source', Setting::castToIntOrFalse()))
    ->addSetting(new Setting('fileSimpleBrowserPath', '/', 'textfield'))

    ->addSetting(new Setting('simpleBrowserDirectoryDepth', 5, 'numberfield'));
$options[] = $simpleBrowser;

$modxBrowser = new Group('media_modxbrowser');
$modxBrowser
    ->addSetting(new Setting('imageMODXBrowser', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('imageMODXBrowserSource', $modx->getOption('default_media_source'), 'modx-combo-source', Setting::castToIntOrFalse()))
    ->addSetting(new Setting('imageMODXBrowserPath', '/', 'textfield'))
    ->addSetting(new Setting('fileMODXBrowser', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('fileMODXBrowserSource', $modx->getOption('default_media_source'), 'modx-combo-source', Setting::castToIntOrFalse()))
    ->addSetting(new Setting('fileMODXBrowserPath', '/', 'textfield'));
$options[] = $modxBrowser;

$link = new Group('link');
$link
    ->addSetting(new Setting('linkTitle', false, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('linkNewTab', false, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('linkNofollow', false, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('linkToAnchor', false, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('linkValidation', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('linkStyles', true, 'textarea', Setting::castJSONToObject()))
    ->addSetting(new Setting('definedlinks', '', 'textarea', Setting::castJSONToObject()));
$options[] = $link;

$linkResource = new Group('link_resource');
$linkResource
    ->addSetting(new Setting('linkResourceLimitToContext', false, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('linkResourceIncludeIntrotext', true, 'checkbox', Setting::castToBool()));
$options[] = $linkResource;

$linkAutoparse = new Group('link_autoparse');
$linkAutoparse
    ->addSetting(new Setting('autoparse', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('autoparseImages', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('autoparseVideo', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('autoparseLinks', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('linkSize', 30, 'numberfield'));
$options[] = $linkAutoparse;


$source = new Group('source');
$source
    ->addSetting(new Setting('source', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('sourceCodemirror', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('sourceBeautify', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('showSource', false, 'checkbox', Setting::castToBool()));
$options[] = $source;

$utilities = new Group('utilities');
$utilities
    ->addSetting(new Setting('limiter', '', 'numberfield', Setting::castToIntOrFalse()))
    ->addSetting(new Setting('clips', '', 'textarea', Setting::castToClipsArray()))
    ->addSetting(new Setting('textexpander', '', 'textarea', Setting::castToClipsArray()))
    ->addSetting(new Setting('variables', '', 'textarea', Setting::castToArray()))
    ->addSetting(new Setting('placeholder', false, 'textarea', Setting::castToStringOrFalse()));
$options[] = $utilities;

$misc = new Group('misc');
$misc
    ->addSetting(new Setting('spellcheck', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('grammarly', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('tabKey', true, 'checkbox', Setting::castToBool()))
    ->addSetting(new Setting('additionalPlugins', '', 'textfield'));
// @todo add special ui to manage shortcodes ->addSetting(new Setting('shortcodes', [], 'textarea'))
// @todo add special ui to manage shortcuts ->addSetting(new Setting('shortcuts', [], 'textarea'))
$options[] = $misc;

return $options;
