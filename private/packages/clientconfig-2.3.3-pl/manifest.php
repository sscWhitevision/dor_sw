<?php return array (
  'manifest-version' => '1.1',
  'manifest-attributes' => 
  array (
    'license' => 'The MIT License (MIT)

Copyright (c) 2016 Mark Hamstra Web Development <hello@markhamstra.com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
',
    'readme' => '-------------------------
ClientConfig
-------------------------
Author: Mark Hamstra
Contact: mark@modmore.com
-------------------------

ClientConfig is the by product of a workshop at MODXpo Europe 2012,
the "Developing Extras in MODX" one. See the session page at modxpo.eu
http://modxpo.eu/schedule/sessions/developing-extras-for-modx-hands-on
for more information and footage of the workshop.

ClientConfig gives your client a user-friendly interface for making site
wide changes, while you as the administrator set up the different options
available to the end-user.

Possible uses include:
- Regularly update a slogan or tag-line in header or footer
- Change call-to-action button colors based on the season
- Keep contact details updated in one central location
- Update the email-address a form sends notifications to.

Licensed under the MIT.',
    'changelog' => 'ClientConfig 2.3.3-pl
---------------------
Released on 2022-09-17

- Guard against pdoToolsOnFenomInit event from triggering more than once causing a fatal loop [#198]
- Fix contexts dropdown not displaying in the same order as the resource tree. Now sorts by rank rather than key. [1eceff9]
- Add tooltips showing placeholder syntax to image and file settings. [#183]
- Fix context aware mode being disabled when upgrading remotely. [#177]

ClientConfig 2.3.2-pl
---------------------
Released on 2022-07-15

- Fix strict type check in plugin for MODX 3.x [#195]
- Lower priority of onHandleRequest event on install so context mode works reliably out of the box with routing plugins. [#196]

ClientConfig 2.3.1-pl
---------------------
Released on 2022-06-13

- Fix "Choose Context" combobox not loading in MODX 3.x [#193]  
- Fix double asterisks being displayed on required fields in MODX 3.x [#189]
- Fix admin grids not resizing when browser is resized [#194]

ClientConfig 2.3.0-pl
---------------------
Released on 2019-10-24

- Add icon to the menu item (when moved to the top navigation) [#175]
- Make placeholders available for inherited fenom templates [#173, #174]
- Make textarea fields bigger and automatically growing with the content [#172]
- Allow a hash in the url containing the ID of a group to automatically open to that tab [#169]
- Add a line/divider field type to create simple sections [#149]
- Add a code field type (requires Ace editor) for things like custom CSS or other markup [#144]
- Add an email field type which validates the value to be an email address [#65]
- Include OnHandleRequest plugin event (alongside OnMODXInit), to make ClientConfig play nicer with various context routing and other solutions that don\'t use OnMODXInit [#140]
- Add separate "Save" and "Save and close" buttons to the setting window [#135]

ClientConfig 2.2.0-pl
---------------------
Released on 2019-08-19

- Fix media source path being included for empty values [#152]
- When context values are empty, it will now fall back to the global value

ClientConfig 2.1.0-pl
---------------------
Released on 2018-12-05

- Update menu to no longer rely on modAction, instead using namespace routing [#158, #139]
- Fix image/file fields not refreshing when switching context [#147, #155]
- Adjust plugin to accept both OnMODXInit and OnHandleRequest so you can change the event it runs on, if needed [#140]
- Prevent events (i.e., priority) from being overwritten on upgrade [#148]

ClientConfig 2.0.0-pl
---------------------
Released on 2018-06-26

- Don\'t add _duplicate to the key when duplicating a setting [#142]
- Updated German [#141], Russian [#145] and Dutch translations

ClientConfig 2.0.0-rc1
----------------------
Released on 2017-10-04

- ClientConfig can now (optionally) manage settings for different contexts [#4/#112]
- Media fields (image/file) now prefix the media source url [#124]
- Allow snippet/chunk tags in options for the dropdown field [#104]
- Updated minimum requirements to PHP 5.5.0 and MODX 2.5.2.
- Added separate clientconfig.categories lexicon for the vertical tabs interface [#91]

ClientConfig 1.4.2-pl
---------------------
Released on 2017-07-22

- Restore PHP 5.3 compatibility in creating settings. Note: next release will require 5.5+!
- Fix issue saving settings on certain environments due to missing value for source [#129]
- Fix incorrect header/container alignment in both manager pages [#128]
- Fix (unused) namespace assets path (on new installs) [#126]

ClientConfig 1.4.1-pl
---------------------
Released on 2017-02-02

- Fix bug where the new source dropdown does not appear for image field types

ClientConfig 1.4.0-pl
---------------------
Released on 2017-01-31

- Fix loading of TinyMCE RTE, causing it to be initialised without configuration [#122]
- Add ClientConfig_ConfigChange event to be able of hooking into configuration changes [#117]
- Change plugin event from OnHandleRequest to OnMODXInit [#87, #109, #115]
- Enable inline editing in the admin component [#94, #95, #114]
- Fix field-required errors not being shown by adding a popup
- Accept 0 as valid required value on the number input [#119]
- Add a Password input type [#105]
- Add a File input type [#36]
- Don\'t show "Error adding field" errors during installation/upgrade [#92]
- Fix loading RTE if the field key contains a dot [#89]
- Add CMD/CTRL + S shortcut for saving the configuration [#80]
- Preserve linebreaks when editing a setting in the admin section by using a textarea for the value [#69]
- Relicense under the MIT license instead of GPL [#67]
- Allow specifying a media source for the image input type [#66]

ClientConfig 1.3.2-pl
---------------------
Released on 2015-12-09

- Update French translation
- Make sure image field uses the MODX default media source
- Respect manager_date_format and manager_time_format settings

ClientConfig 1.3.1-pl
---------------------
Released on 2014-07-20

- Update Dutch translation
- More weird border fixes
- Minor fix to when borders are added, specifically for 2.2.

ClientConfig 1.3.0-pl
---------------------
Released on 2014-07-19

- #27 Ability to import/export groups and settings
- #16 Auto-select first group when adding a setting
- #15 Force admins to create a group before creating a setting, as settings need groups
- #76 Fix issue where unchecking a checkbox would fail if the setting was required
- #78 Make the is_required column show Yes/No instead of true/false
- #60 Get rid of an extra border
- #75 Update help link to point to modmore.com

ClientConfig 1.2.1-pl
---------------------
Released on 2014-01-07

- #57 Add Google Font input type (Thanks @garryn)
- #63 Fix issue loading more than one rich text field

ClientConfig 1.2.0-pl
---------------------
Released on 2013-08-16

- #38 Add setting (vertical_tabs) to allow stacking groups vertically instead of horizontal tabs
- #46 Add ability to duplicate a setting
- #45 Show field options field when editing a select box setting.
- #54 Add Rich Text input type.
- Improved width consistency of input items.
- #37 Added input type Image (thanks COEX!)
- #3 Fix/add colorpicker input type (thanks COEX!)

ClientConfig 1.1.2-pl
---------------------
Released on 2013-03-07

- Add/update translations: Russian (thx @Alroniks!), German (thx @enigmatic-user!), Swedish (thx @fractalwolfe!) and Dutch.
- #47 Show field descriptions under the fields. (Thanks @fractalwolfe!)
- #40 Add placeholder tooltips with the  for admins. (Thanks @fractalwolfe!)

ClientConfig 1.1.1-pl
---------------------
Released on 2012-12-31

- #35 Don\'t strip out tags when saving values (relies on allow_tags_in_post=true in mgr context).
- #39 Increase database field max sizes for longer descriptions and values.
- #33 Make sure to show message when no tabs are to be shown.
- #34 Prevent E_WARNING when there are no settings configured.

ClientConfig 1.1.0-pl
---------------------
Released on 2012-12-16

- #26 Add ability to manually sort Settings within a Group
- #25 Add ability to manually sort Groups
- #21 Add Filter on Group for settings.
- #24 Remember last visited tab in both admin and client view.
- #22 Add "Help!" button on Admin panel linking to RTFM instructions.
- Improve checking if key exists on updating a setting.
- #30 Fix bug with incorrectly checking cgSetting.is_required checkbox
- Make controller a tad more portable.

ClientConfig 1.0.0-pl
---------------------
Released on 2012-12-09

First release
',
    'setup-options' => 'clientconfig-2.3.3-pl/setup-options.php',
  ),
  'manifest-vehicles' => 
  array (
    0 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modNamespace',
      'guid' => '5a1bd80643cb0860572e1ded1e0a92c4',
      'native_key' => 'clientconfig',
      'filename' => 'modNamespace/4f667c9ed391f0cf93504d559f6cdc55.vehicle',
      'namespace' => 'clientconfig',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '08a05843c0719ddded8c481b66e124b5',
      'native_key' => 'clientconfig.admin_groups',
      'filename' => 'modSystemSetting/ad33438a948701840e20d848cfe78e8c.vehicle',
      'namespace' => 'clientconfig',
    ),
    2 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f05b99a5d698e76d0fe13f5f82994e7b',
      'native_key' => 'clientconfig.clear_cache',
      'filename' => 'modSystemSetting/c055d1d1c5e5b3c24f2fbd5f7f23f2ab.vehicle',
      'namespace' => 'clientconfig',
    ),
    3 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '263ce2cab4e6fd1b7c5f0216e5f9c054',
      'native_key' => 'clientconfig.vertical_tabs',
      'filename' => 'modSystemSetting/c403c2853334afcbf9f886351c1d6bb5.vehicle',
      'namespace' => 'clientconfig',
    ),
    4 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '5dd6eb82725b1e80a8af02d851e5e90c',
      'native_key' => 'clientconfig.context_aware',
      'filename' => 'modSystemSetting/bfe20f8837657aa84971e91ae0cd2965.vehicle',
      'namespace' => 'clientconfig',
    ),
    5 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f8bccdb10fe58ef26528521f1a4c3aa0',
      'native_key' => 'clientconfig.google_fonts_api_key',
      'filename' => 'modSystemSetting/a80140a8c3a77bddb5ff4a02fcdb6c15.vehicle',
      'namespace' => 'clientconfig',
    ),
    6 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '891ff59f8438e39bd5985120f366f1a3',
      'native_key' => 'ClientConfig_ConfigChange',
      'filename' => 'modEvent/3d02891965ec5e6e83bffeb8b8fb05c9.vehicle',
      'namespace' => 'clientconfig',
    ),
    7 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modPlugin',
      'guid' => 'da369da4e3f61fdfc1628d0ad7e55d9a',
      'native_key' => 1,
      'filename' => 'modPlugin/e8252b2d2d489e7be2a74de203f3a190.vehicle',
      'namespace' => 'clientconfig',
    ),
    8 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modMenu',
      'guid' => 'cc92490abff08fb6fa8c7b186d0e7e73',
      'native_key' => 'clientconfig',
      'filename' => 'modMenu/4ecd9d0be7863b88f268eea49d22f1da.vehicle',
      'namespace' => 'clientconfig',
    ),
    9 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modCategory',
      'guid' => 'f2f35ba6ad01c616293801af33603fd9',
      'native_key' => 1,
      'filename' => 'modCategory/33ebcad1559d419b9dff57f3fd7beecb.vehicle',
      'namespace' => 'clientconfig',
    ),
  ),
);