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
    'changelog' => 'ClientConfig 2.3.2-pl
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
    'setup-options' => 'clientconfig-2.3.2-pl/setup-options.php',
  ),
  'manifest-vehicles' => 
  array (
    0 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modNamespace',
      'guid' => '5a42275481972cb00adbf3824359457e',
      'native_key' => 'clientconfig',
      'filename' => 'modNamespace/20aa585f15ba77e5bc9a60295cb1f5b1.vehicle',
      'namespace' => 'clientconfig',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'bdab22af9ef2ced7827d231417b49cd4',
      'native_key' => 'clientconfig.admin_groups',
      'filename' => 'modSystemSetting/2b5cb59066185aa2a0be9e5697ee039e.vehicle',
      'namespace' => 'clientconfig',
    ),
    2 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b1bc79a570c0c3c8925864407a8cce6b',
      'native_key' => 'clientconfig.clear_cache',
      'filename' => 'modSystemSetting/c049f9f7c2a566f199225bdb581a5fc3.vehicle',
      'namespace' => 'clientconfig',
    ),
    3 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ff677e37bd6224f286b904f5a4a5f56b',
      'native_key' => 'clientconfig.vertical_tabs',
      'filename' => 'modSystemSetting/26b6f8d48994390b86912922505b6cb3.vehicle',
      'namespace' => 'clientconfig',
    ),
    4 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '43c6137696e5d2541f6e7abcb15d690f',
      'native_key' => 'clientconfig.context_aware',
      'filename' => 'modSystemSetting/015655e040de77d3a92b63cd766f15e6.vehicle',
      'namespace' => 'clientconfig',
    ),
    5 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '081fb192cf666e069eead9872c799161',
      'native_key' => 'clientconfig.google_fonts_api_key',
      'filename' => 'modSystemSetting/0562c0144bdf3317e00c25a6dff5fa22.vehicle',
      'namespace' => 'clientconfig',
    ),
    6 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '055c0b262dd310281e86585704b30c37',
      'native_key' => 'ClientConfig_ConfigChange',
      'filename' => 'modEvent/91ed6dc12b5df893674063f54edabeea.vehicle',
      'namespace' => 'clientconfig',
    ),
    7 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modPlugin',
      'guid' => '44e57010ba63ced432d0b9f4097df24d',
      'native_key' => 1,
      'filename' => 'modPlugin/67bcd2f4c57fe044d401880254a4ac03.vehicle',
      'namespace' => 'clientconfig',
    ),
    8 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modMenu',
      'guid' => '8e7d22fa36f9720d1d515a53341ee9f2',
      'native_key' => 'clientconfig',
      'filename' => 'modMenu/bb0203caffd84dd828c1cb11c484e2f8.vehicle',
      'namespace' => 'clientconfig',
    ),
    9 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modCategory',
      'guid' => '94eff9aab1fbabac69d798141d1e1824',
      'native_key' => 1,
      'filename' => 'modCategory/3f89df93322183b2450ac8182e3da370.vehicle',
      'namespace' => 'clientconfig',
    ),
  ),
);