id: 27
source: 2
name: ManagerCustomizationsWV
properties: 'a:0:{}'

-----

// for admins
if ($modx->user->isMember('Administrator')) {
    
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
            background:transparent;
            margin: 3rem 0;
        }
        .contentblocks-add-layout h3 a:hover {
            background:transparent;
            color:#3697cd !important;
        }

        .contentblocks-region-container-header {
            border-bottom: 5px solid #f5f5f5 !important;
            border-top: 10px solid #3697cd !important;
            background:#fff !important;
            box-shadow:none !important;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .contentblocks-region-container-header h3,
        .contentblocks-region-container-header 
        .contentblocks-layout-title-edit {
            padding-left: 16px !important;
        }
        .contentblocks-add-template-category {
            padding-bottom:30px;
        }
        .contentblocks-field-upload,
        .contentblocks-field-image-url {
            display:none;
        }
        .ace_text-input {
            max-height:200px;
            resize: vertical;
        }
        .x-form-item label.x-form-item-label .modx-tv-label-description { 
            display: block; 
        }
    </style>
    ';

    $modx->regClientCSS($css);
}

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
        .contentblocks-add-content-here-link {
            display:none !important;
        }
        .contentblocks-add-layout h3 a {
            background:transparent;
            margin: 3rem 0;
        }
        .contentblocks-add-layout h3 a:hover {
            background:transparent;
            color:#3697cd !important;
        }
        
        .contentblocks-region-container-header {
            border-bottom: 5px solid #f5f5f5 !important;
            border-top: 10px solid #3697cd !important;
            background:#fff !important;
            box-shadow:none !important;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .contentblocks-region-container-header h3,
        .contentblocks-region-container-header 
        .contentblocks-layout-title-edit {
            padding-left: 16px !important;
        }
        .contentblocks-add-template-category {
            padding-bottom:30px;
        }
        .contentblocks-field-upload,
        .contentblocks-field-image-url {
            display:none;
        }
        .ace_text-input {
            max-height:200px;
            resize: vertical;
        }
        .x-form-item label.x-form-item-label .modx-tv-label-description { 
            display: block; 
        }
    </style>
    ';

    $modx->regClientCSS($css);
}

return '';