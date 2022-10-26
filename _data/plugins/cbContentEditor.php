id: 20
source: 2
name: cbContentEditor
properties: 'a:0:{}'

-----

/**
 * Content Blocks cbContentEditor Plugin
 * 
 * This plugin hides certain CB buttons from certain MODX user groups
 * and disables the drag and drop functionality, so that you can provide
 * some clients with a more locked down version of CB.
 * 
 * I would suggest setting up CB templates and defaults in the CB component manager,
 * so that predefined layouts are loaded automatically when a new resource is created. 
 * It is also recommended that you hide the main content area on "resource/create" using form 
 * customisation, other wise when a user creates a new page, they will be able to delete blocks 
 * and use drag & drop, because no Resource ID has been defined yet (this only happens on save).
 * 
 * Tested on: MODX 2.6.1, Content Blocks
 *
 * Events: OnDocFormPrerender
 *
 * @author Jon Leverrier <jon@youandmedigital.com>
 *
 */
switch ($modx->event->name) {
    // load on system event OnDocFormPrerender
    case 'OnDocFormPrerender':
        
        // get the current resource ID
        $resource = $modx->resource;
        // for newly created resources, there will be no ID until the page is saved. So if there
        // is no ID, stop here...
        if (!$resource) {
            return;
        }
        // check to see if CB is enabled on a resource
        $isContentBlocks = $resource->getProperty('_isContentBlocks', 'contentblocks', null);
        
        // only load for a specific user group and if CB is enabled on the resource
        // Original:  if ($modx->user->isMember('Administrator') && $isContentBlocks = true) {
        if ($isContentBlocks = true) {
                // load custom script to prevent drag and drop feature in CB
                // (need to find a better way todo this)
                $modx->regClientStartupHTMLBlock('
            	   <script>
                        jQuery(function($) {
                            var checkCB = setInterval(function() {
                                if (ContentBlocks.initialized) {
                                    $("#contentblocks .contentblocks-field-wrap").addClass("prevent-drag");
                                    $("#contentblocks .contentblocks-repeater-wrapper").parents(".prevent-drag").removeClass("prevent-drag");
                                    clearInterval(checkCB);
                                }
                            }, 50);
                        });
                    </script>
                ');
        } else{
            // if the check fails, do nothing
            return;
        }
        break;
}