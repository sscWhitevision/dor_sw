<?php return array (
  'manifest-version' => '1.1',
  'manifest-attributes' => 
  array (
    'license' => 'This license is a legal agreement between you and modmore for the use of the Redactor extra for MODX. By downloading or installing Redactor, you agree to the terms and conditions of this license. modmore reserves the right to alter this agreement at any time, for any reason, without notice.

modmore grants you a non-exclusive non-transferable license to use Redactor on one MODX installation, identified by its domain name. A license code is embedded in this package, which is associated with your account on modmore.com and is not transferable to other accounts. Changes to the MODX installation, such as moving to a different domain, invalidates this license. For your convenience, you will receive automatic instructions on resolving such invalidations via email.

Neither the installable package nor the source code may be redistributed, changed, stripped of its license information or license verification code, or otherwise modified without upfront written permission. Any attempt to block, jeopardize or fool built-in protections and/or license verification is strictly forbidden and cause for account termination.

Should you require multiple environments (test/staging) for a single MODX installations, each environment requires its own license. Free development licenses may be available. Please see: https://modmore.com/free-development-licenses/

Support is available for the most recent major version via support@modmore.com. Upon the release of a new major version or discontinuation, support will remain available for 6 months. For the current supported versions and timelines, please see: https://modmore.com/about/support/

modmore is not liable for any damages directly or indirectly caused by usage of Redactor.

modmore may revoke this license at any time.

---

This extra includes third party software, for which we are thankful.

- Redactor.js by Imperavi (imperavi.com), including plugins, OEM License.
- CodeMirror, MIT license
- Autocomplete.js by Algolia, MIT license
',
    'readme' => 'Welcome to Redactor 3.

Redactor is a powerful and user friendly rich text editor for MODX. It is based on the commercial Redactor editor built by Imperavi, enhanced with MODX-specific customisations and management.

With Redactor you get a tightly integrated editor experience. The editor integrates with the MODX media manager and media sources, allows direct linking to resources, and looks great within the manager design.

Redactor also integrates nicely with other extras. Third party extras can seamlessly enable Redactor on fields they want to use a rich text editor for. We love pairing Redactor with ContentBlocks ourselves.

For more information about the functionality offered by Redactor 3, please visit https://modmore.com/redactor/ or the documentation at https://docs.modmore.com/en/Redactor/v3.x/index.html

Standard unlimited support is included with your license purchase. If you have questions or need help, please email support@modmore.com.
',
    'changelog' => 'Redactor 3.1.2-pl
------------------
Released on 2021-10-27

- Further license-related tweaks for MODX 3.0.0-alpha3

Redactor 3.1.1-pl
------------------
Released on 2021-10-27

- Allow installation on MODX 3.0.0-alpha3
- Updated Redactor.js from v3.4.8 to v3.5.2, for details: https://imperavi.com/redactor/log/

Redactor 3.1.0-pl
------------------
Released on 2021-02-09

- Adjust z-index for fullscreen Ace editor to prevent navbar issues [F2035-11]
- Fix z-index for redactor modals hiding behind MIGX and other popups after a Redactor.js update changed modal IDs [#522]
- Update divider plugin to work more reliably with improved toolbar.addButton behavior in redactor.js
- Sort button-related plugins by order in which they are used, to improve reliability of positioning [#519, S24844]
- Update Redactor.js from v3.4.5 to v3.4.8, including improved XSS protections: https://imperavi.com/redactor/log/
- Patch toolbar.addButton with fix for buttons disappearing if the button before it isn\'t yet loaded
- Add ability to customise the font family and color options available in fontfamily and fontcolor dropdowns [#509]

Redactor 3.0.2-pl
------------------
Released on 2020-10-27

- Allow installation on PHP 7.1 again
- Guard against calling MODx.loadRTE/loadRedactorConfigurationSet without an element [#22971]
- Make sure resources are marked as having changes pending when editing in the RTE [#515]
- Fix image resize handler not being visible when Redactor is used in a modal popup [#507]
- Updated Redactor.js from v3.3.3 to 3.4.5, for details: https://imperavi.com/redactor/log/

Redactor 3.0.1-pl
------------------
Released on 2020-04-06

- Fix resource-related path placeholders not working [#21971]

Redactor 3.0.0-pl
------------------
Released on 2020-02-14

- Fix error in MODX3 due to strict typing
- Update to redactor.js v3.3.3; this prevents the editor from breaking when unlisting content. [#502]
- Automatically enable the imported configuration set when upgrading from v2 [#504]
- Add the .redactor-editor content style class to the set imported from v2 [S21929]
- Support custom configuration set to use with MIGX TVs, see: https://docs.modmore.com/en/Redactor/v3.x/Usage/MIGX.html [#501]

Changelog for redactor.js v3.3.3:
- Fixed: When formatting the list, the content is removed if the editor within the list.
- Fixed: Adding rows and columns to the table is available even if the cursor is not in the table.
- Improved: XSS sanitize when inserting svg and img.
- New: Setting source.codemirrorSrc if codemirror is used as a module.

Redactor 3.0.0-rc3
------------------
Released on 2020-02-05

- Prevent installation from continuing if server requirements aren\'t met
- Fix autocomplete for links only working in the first redactor instance per page (e.g. in ContentBlocks) [#500]
- Fix CSS scoping issue for CodeMirror, causing conflict with standalone CodeMirror extension [#503]

Redactor 3.0.0-rc2
------------------
Released on 2020-01-16

- Don\'t load English translation file to avoid emptying plugin translation strings (alignment, clips) [S21859]
- Fix z-index issues with the MODX media browser, by not overriding the z-index to make it appear in front of Redactor-built modals but closing the initiating Redactor modal window instead. [S21859]
- Add support for shift+tab to outdent within lists [B31]
- Fix replaced images not being saved [B31]
- Restore fixed toolbar to normal toolbar when opening full screen mode [#492]
- Split autoparse options in the configurator to a separate tab
- Add options for resource links: limit to current context, include introtext [S21862]
- Make directory depth for the simple browser configurable
- When adding a link, the resource search will now automatically query for the selected text
- Fix link styles not working correctly with multiple classnames
- Fix image styles not preselecting current styles when it has multiple classnames

Redactor 3.0.0-rc1
------------------
Released on 2020-01-14

Welcome to Redactor 3. A refreshed and modernised take on the rich text editor.

This is a major release and paid upgrade for users of Redactor 2. Learn more in the release announcement: https://modmore.com/blog/2020/redactor-3/

Some of the highlights in Redactor 3:

- Configuration is now managed with Configuration Sets. After installation, browse to Extras > Redactor Configuration to start. On upgrade, your previous settings will be (as much as possible) migrated to the new format, including context-specific overrides
- Much simpler media manager is now included by default. You can also use the standard MODX browser, or both!
- New input type for ContentBlocks allowing you to choose a configuration set per field
- You can now choose a configuration set per template
- New `divider` button lets you visually separate toolbar buttons
- Different themes are now supported, including the new default, a Redactor 2-inspired theme, and one filled with rainbows
- New properties plugin to set IDs and classes on any block element
- Improved core editing experience with better cleanup and some long-standing issues resolved
- redactor.css setting now support a comma separated list of CSS files rather than just one
- Sanitising file names now supports transliteration
- New Image Styles option lets you define classes that can be added to an image
- Experimental support for Fred
- Redactor plugins from Imperavi, which often do not ship with a translation, can now be translated through the MODX lexicon system

Powered by Imperavi\'s redactor.js v3.3.2.
',
    'standard-set' => '<?xml version="1.0" encoding="UTF-8"?>
<data package="redactor" exported="2019-08-26@13:09:31" total="2">
	<redConfigurationSet>
		<class_key><![CDATA[redConfigurationSet]]></class_key>
		<name><![CDATA[Standard]]></name>
		<description><![CDATA[]]></description>
		<content><![CDATA[{"buttons":"format, bold, italic, underline, divider, table, link, image, file, divider, ol, ul, indent, outdent, divider, redo, undo, divider, html","buttonsTextLabeled":"0","formatting":"p, h2, h3, h4, h5, h6, blockquote, pre","formattingAdd":"","air":"0","toolbar":"1","toolbarContext":"1","lang":"en","theme":"default","minHeight":"200","maxHeight":"","maxWidth":"","animation":"1","structure":"0","counter":"0","stylesClass":"redactor-styles","direction":"ltr","cleanOnEnter":"1","cleanInlineOnEnter":"1","removeScript":"1","removeNewLines":"0","removeComments":"1","pasteClean":"1","pastePlainText":"0","pasteLinks":"1","pasteLinkTarget":"false","pasteImages":"1","pasteBlockTags":"pre, h1, h2, h3, h4, h5, h6, table, tbody, thead, tfoot, th, tr, td, ul, ol, li, blockquote, p, figure, figcaption","pasteInlineTags":"a, img, br, strong, ins, code, del, span, samp, kbd, sup, sub, mark, var, cite, small, b, u, em, i","pasteKeepStyle":"","pasteKeepClass":"","pasteKeepAttrs":"","markup":"p","enterKey":"1","breakline":"0","preClass":"false","preSpaces":"4","tabAsSpaces":"","imageFigure":"1","imageCaption":"1","imagePosition":"1","imageFloatMargin":"1em","imageEditable":"1","imageResizable":"1","dragUpload":"1","clipboardUpload":"1","baseurlsMode":"relative","imageSimpleBrowser":"1","imageSimpleBrowserSource":"1","imageSimpleBrowserPath":"\\/assets\\/","fileSimpleBrowser":"1","fileSimpleBrowserSource":"1","fileSimpleBrowserPath":"\\/assets\\/","imageMODXBrowser":"1","imageMODXBrowserSource":"1","imageMODXBrowserPath":"\\/assets\\/","fileMODXBrowser":"1","fileMODXBrowserSource":"1","fileMODXBrowserPath":"\\/assets\\/","linkTitle":"1","linkNewTab":"1","linkNofollow":"0","linkToAnchor":"0","linkSize":"30","linkValidation":"1","definedlinks":"","autoparse":"1","autoparseLinks":"1","autoparseImages":"1","autoparseVideo":"1","source":"1","sourceCodemirror":"1","showSource":"0","limiter":"","clips":"","textexpander":"","variables":"","placeholder":"false","spellcheck":"1","grammarly":"0","tabKey":"1"}]]></content>
	</redConfigurationSet>
	<redConfigurationSet>
		<class_key><![CDATA[redConfigurationSet]]></class_key>
		<name><![CDATA[Minimal]]></name>
		<description><![CDATA[]]></description>
		<content><![CDATA[{"buttons":"format, divider, bold, italic, underline, deleted, divider, link, image","buttonsTextLabeled":"0","formatting":"p, h2, h3, h4, blockquote, code","formattingAdd":"","air":"0","toolbar":"1","toolbarContext":"1","lang":"en","theme":"default","minHeight":"100","maxHeight":"","maxWidth":"","animation":"1","structure":"0","counter":"0","stylesClass":"redactor-styles","direction":"","cleanOnEnter":"1","cleanInlineOnEnter":"1","removeScript":"1","removeNewLines":"0","removeComments":"1","pasteClean":"1","pastePlainText":"0","pasteLinks":"1","pasteLinkTarget":"false","pasteImages":"1","pasteBlockTags":"h1, h2, h3, h4, h5, h6, table, tbody, thead, tfoot, th, tr, td, ul, ol, li, blockquote, pre","pasteInlineTags":"strong, b, u, em, i, code, del, span, ins, samp, kbd, sup, sub, mark, var, cite, small","pasteKeepStyle":"","pasteKeepClass":"","pasteKeepAttrs":"","markup":"p","enterKey":"1","breakline":"0","preClass":"false","preSpaces":"4","tabAsSpaces":"","imageFigure":"1","imageCaption":"1","imagePosition":"0","imageFloatMargin":"10px","imageEditable":"1","imageResizable":"1","dragUpload":"1","clipboardUpload":"1","baseurlsMode":"relative","imageSimpleBrowser":"0","imageSimpleBrowserSource":"1","imageSimpleBrowserPath":"\\/","fileSimpleBrowser":"0","fileSimpleBrowserSource":"1","fileSimpleBrowserPath":"\\/","imageMODXBrowser":"1","imageMODXBrowserSource":"1","imageMODXBrowserPath":"\\/","fileMODXBrowser":"1","fileMODXBrowserSource":"1","fileMODXBrowserPath":"\\/","linkTitle":"1","linkNewTab":"0","linkNofollow":"0","linkToAnchor":"0","linkSize":"50","linkValidation":"1","definedlinks":"","autoparse":"1","autoparseLinks":"1","autoparseImages":"1","autoparseVideo":"1","source":"1","sourceCodemirror":"1","showSource":"0","limiter":"","clips":"","textexpander":"","variables":"","placeholder":"false","spellcheck":"1","grammarly":"1","tabKey":"1"}]]></content>
	</redConfigurationSet>
</data>',
  ),
  'manifest-vehicles' => 
  array (
    0 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modNamespace',
      'guid' => '65719b3582db707616e79840a9f12f3f',
      'native_key' => 'redactor',
      'filename' => 'modNamespace/d04f24ffef0b253295e85f1f963baf74.vehicle',
      'namespace' => 'redactor',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOFileVehicle',
      'class' => 'xPDOFileVehicle',
      'guid' => '98cae84ad0f51dbb626c45b21a3a52fc',
      'native_key' => '98cae84ad0f51dbb626c45b21a3a52fc',
      'filename' => 'xPDOFileVehicle/90251271e8b48c81be0d744aa7458766.vehicle',
    ),
    2 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOFileVehicle',
      'class' => 'xPDOFileVehicle',
      'guid' => '7f91e4787315ec8262e6fa6c9e7e4df5',
      'native_key' => '7f91e4787315ec8262e6fa6c9e7e4df5',
      'filename' => 'xPDOFileVehicle/46a4310533ca5292092c849a2b53425c.vehicle',
    ),
    3 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e70fc3bd58d11b34f7dd85c73f4ada0e',
      'native_key' => 'redactor.configuration_set',
      'filename' => 'modSystemSetting/2ea4f853970ac735d591389cb7708a25.vehicle',
      'namespace' => 'redactor',
    ),
    4 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b7165962dae810fff892bb0a87edef81',
      'native_key' => 'redactor.introtext',
      'filename' => 'modSystemSetting/758f8a78d3ebc1339f1304d89b9c7e56.vehicle',
      'namespace' => 'redactor',
    ),
    5 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a4b7d3723704406e8b26015eafb941bf',
      'native_key' => 'redactor.introtext.configuration_set',
      'filename' => 'modSystemSetting/a243b1696c3ff032705adc8b040e88c8.vehicle',
      'namespace' => 'redactor',
    ),
    6 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f0f8fc975ffbf293d2a31fa04499c636',
      'native_key' => 'redactor.css',
      'filename' => 'modSystemSetting/21f0a8ade02fd72a602ed237898f3fdb.vehicle',
      'namespace' => 'redactor',
    ),
    7 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'fcee8075d660dfb803e3ce2ff73b6a32',
      'native_key' => 'redactor.js',
      'filename' => 'modSystemSetting/fa69ddacf79f600a244893435988cb94.vehicle',
      'namespace' => 'redactor',
    ),
    8 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a64b14eb2a54670607d9694c66752354',
      'native_key' => 'redactor.sanitizePattern',
      'filename' => 'modSystemSetting/7dce1f751399b79414c54f0f8bb547d4.vehicle',
      'namespace' => 'redactor',
    ),
    9 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '906474e2eb88c050e49271ac3cda43f4',
      'native_key' => 'redactor.sanitizeReplace',
      'filename' => 'modSystemSetting/6a08cdcb24d2f92e656ce128eaafc59c.vehicle',
      'namespace' => 'redactor',
    ),
    10 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f591139321d3671486bb9b46a000a271',
      'native_key' => 'redactor.translit',
      'filename' => 'modSystemSetting/dd06f1f4d6daa72fcaf0c0b51146db15.vehicle',
      'namespace' => 'redactor',
    ),
    11 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b641e7dcb87687db0d46f978e910d910',
      'native_key' => 'redactor.translit_class',
      'filename' => 'modSystemSetting/4758bcd738c7566cc7e2d0d2d8013b9f.vehicle',
      'namespace' => 'redactor',
    ),
    12 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '46b084c7939d5773a3aaf7264b64009f',
      'native_key' => 'redactor.translit_class_path',
      'filename' => 'modSystemSetting/24b69758d50221dd0943eb779acf8d97.vehicle',
      'namespace' => 'redactor',
    ),
    13 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modMenu',
      'guid' => 'f1f02142eb6e06cbf9eaa161cc9423eb',
      'native_key' => 'redactor.configuration',
      'filename' => 'modMenu/df3f9eb418119b880ece042f7268fafe.vehicle',
      'namespace' => 'redactor',
    ),
    14 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modAccessPolicyTemplate',
      'guid' => '546675e508a269fdd8d5e338db2d4512',
      'native_key' => NULL,
      'filename' => 'modAccessPolicyTemplate/820a7c58f4e8b9d7a9369e8ee69d271e.vehicle',
      'namespace' => 'redactor',
    ),
    15 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'encryptedVehicle',
      'class' => 'modPlugin',
      'guid' => '87a2fd5e27558d41a8243f2ae02a808b',
      'native_key' => NULL,
      'filename' => 'modPlugin/a3fe47d2b4dfe5bce0324e8c402572df.vehicle',
      'namespace' => 'redactor',
    ),
    16 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOScriptVehicle',
      'class' => 'xPDOScriptVehicle',
      'guid' => '0d4f94600152f473de1dea1c482acdaf',
      'native_key' => '0d4f94600152f473de1dea1c482acdaf',
      'filename' => 'xPDOScriptVehicle/b76692c81c1ddb9b335ffb4123230667.vehicle',
      'namespace' => 'redactor',
    ),
  ),
);