id: 8
source: 2
name: ManagerCustomizations
properties: 'a:0:{}'
disabled: 1

-----

$modx->regClientStartupHTMLBlock('
    <style>
        /* hide seopro keywords */
        .seopro-counter-keywords {
            display: none !important;
        }
        #x-form-el-seopro-keywords, label[for="seopro-keywords"].x-form-item-label, label[for="pagetitle"].desc-under {
            display: none !important;
        }
        
        /* Hide seoTab title in tab */
        #seo-tab #modx-resource-vtabs-header-title {
            display: none;
        }
    </style>
');

// for non admins
if (!$modx->user->isMember('Administrator')) {
    $css = '
    <style>
        #limenu-about {
            display: none !important;
        }
        #modx-abtn-help {
            display: none !important;
        }
        
        
        /* Content Blocks - Module Elements */
        #modx-resource-content {
            box-shadow: none;
        }
        
        #modx-resource-content .x-panel-header {
            display: none;
        }
        
        .contentblocks-add-layout h3 a {
            background: transparent;
            margin: 1.5rem 0;
        }
        
        .contentblocks-layout-wrapper .contentblocks-collapser {
            background: transparent;
            left: auto;
        }
        
        .contentblocks-layout-title {
            padding-left: 35px;
        }
        
        .contentblocks-region-container-header {
            box-shadow: none !important;
        }
        
        .contentblocks-add-content-here {
            display: none;
        }
        
        .contentblocks-layout-wrapper .contentblocks-field-wrap {
            border-bottom: 0;
            padding: 10px 15px;
        }
        
        .contentblocks-layout-wrapper .contentblocks-region.contentblocks-region-middle {
            border-bottom: 0;
        }
        
        .contentblocks-region-container {
            box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.4s ease-in-out;
        }
        .contentblocks-region-container:focus-within {
            box-shadow: 0 0 5px 0 rgba(47, 140, 198, 0.7);
        }
        
        .contentblocks-field-button.big {
            margin-bottom: 1rem;
        }
        
        .contentblocks-field-repeater .contentblocks-repeater-collapser + label {
            display: none;
        }
        
        .contentblocks-repeater-collapser {
            display: none !important;
        }
        
        .contentblocks-field-actions-top {
            display: none;
        }
        
        
        .contentblocks-layout-wrapper li:first-child > .contentblocks-add-layout {
            display: none;
        }
        
        /* show/hide Add-Content-Button in some modules - hide by default */
        li:not([data-layout="4"]):not([data-layout="13"]):not([data-layout="16"]) .contentblocks-add-block {
            display: none;
        }
        
        /* hide content blocks image and file upload and url buttons */
        .contentblocks-field-image-upload .contentblocks-field-upload,
        .contentblocks-field-image-upload .contentblocks-field-image-url,
        .contentblocks-field-file-upload .contentblocks-field-upload {
            display: none !important;
        }
        .contentblocks-field-image-upload {
            color: transparent;
        }
        
        /* hide resource settings */
        #modx-page-settings-right .x-panel-body > *:not(:nth-child(1)):not(:nth-child(2)):not(:nth-child(3)) {
            display: none;
        }
        
        /* hide empty CB Layout columns */
        .contentblocks-column-is-empty {
            display: none !important;
        }
 
    </style>
    ';
 
    $modx->regClientCSS($css);
}

// for admins
if ($modx->user->isMember('Administrator')) {
    $css = '
    <style>
        
    </style>
    ';
 
    $modx->regClientCSS($css);
}

return '';