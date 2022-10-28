<?php return array (
  'manifest-version' => '1.1',
  'manifest-attributes' => 
  array (
    'license' => 'ConsentFriend is proprietary software, developed by Thomas Jakobi for Treehill
Studio. By purchasing ConsentFriend you have received a usage license for one
single MODX Revolution installation, including one year email support (starting
at the day of purchase).

While we hope that ConsentFriend is useful for you, and we will try to help you
successfully use ConsentFriend, Treehill Studio is not liable for loss of
revenue, damages or other financial loss resulting from the installation or use
of ConsentFriend.

By using and installing this package, you acknowledge that you shall only use
this on one single MODX installation.

Redistribution in any shape or form is strictly prohibited. You may customize or
change the provided source code of ConsentFriend for your own needs, as long as
there is no attempt to remove the license protection code. By changing the
source code you acknowledge that you lose your right of support unless the code
change is coordinated with the support of Treehill Studio.
',
    'readme' => '# ConsentFriend

Consent management platform for MODX

- Author: Thomas Jakobi <office@treehillstudio.com>
- License: Proprietary

## Features and License

For a list of features and licensing possibilities, please check https://modmore.com/consentfriend/

## Installation

MODX Package Management

## Documentation

For more information please read the documentation on https://docs.modmore.com/en/ConsentFriend/v1/index.html

## Translations

Translations of ConsentFriend can be made on [Weblate](https://hosted.weblate.org/projects/treehillstudio/)

## Third party licenses

This extra includes third party software, for which we are thankful.

- Klaro (by KIProtect GmbH), BSD 3-Clause License (core/components/consentfriend/docs/klaro-license.txt).
- Symfony YAML, MIT License
',
    'changelog' => '# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.5.3] - 2022-09-10

### Fixed

- Fix a widget issue, when when the user is not an admin
- Fix some styling issues in the custom manager page

## [1.5.2] - 2022-08-15

### Fixed

- Fix date column renderer in Safari
- Fix html validator issue \'Element “script” must not have attribute “defer” unless attribute “src” is also specified\'

## [1.5.1] - 2022-07-04

### Added

- Enable/disable ConsentFriend for templates by system settings

## [1.5.0] - 2022-06-23

### Added

- Context based service configuration
- New system setting consentfriend.use_contexts
- New contexts tab for assigning services to contexts
- Clear the ConsentFriend cache, when the MODX cache is cleared
- Inline editing of some columns in the service and purpose grid

### Changed

- Don\'t allow invalid MODX lexicon strings to break the Klaro lexicon

## [1.4.6] - 2022-04-25

### Added

- Status message with a successful download
- Add missing data-type="text/css" automatically in a service

### Fixed

- Fix a PHP warning in the user agent check

## [1.4.5] - 2022-03-16

### Changed

- Update lexicon

## [1.4.4] - 2022-02-28

### Added

- Install the Composer dependencies directly on the server

### Fixed

- Fix loading the wrong javascript when a css_url is implicitly set

## [1.4.3] - 2022-02-25

### Fixed

- Fix a wrong DB query during logging
- Show the logs of the current day in the widget

## [1.4.2] - 2022-02-24

### Changed

- User agent filter for the logging

## [1.4.1] - 2022-02-16

### Changed

- Update the visitor consent state during logging (if needed).

### Added

- Link to the ConsentFriend manager page on the dashboard widget

## [1.4.0] - 2022-02-12

### Added

- Add Czech, Portuguese and Chinese lexicon
- Additional \'consentfriend-\' prefix for css variables
- Set a depending plugin priority for the OnHandleRequest event
- Log session-based status of accepted and denied services from visitors with an anonymized IP address for later analysis
- Dashbord widget to see the logged data of ConsentFriend usage

## [1.3.5] - 2021-11-12

### Fixed

- MODX 3 beta compatibility

## [1.3.4] - 2021-09-10

### Fixed

- Fix a wrong isArray check
- Fix a too greedy regular expression for selecting the starting head tag 

## [1.3.3] - 2021-06-10

### Fixed

- Fix registering the the script tag in the head section with attributes in the head tag
- Fix a loadDropZones script issue in the modal window in the MODX backend

## [1.3.2] - 2021-04-29

### Fixed

- Fix default themes because of renamed scss variables in Klaro

## [1.3.1] - 2021-04-25

### Fixed

- Fix a install resolver issue

## [1.3.0] - 2021-04-23

### Added

- Import configuration during package setup from file located in `{core_path}/config/consentfriend/`
- Add Facebook Pixel service to the demo services
- Add Google Tag Manager service to the demo services

### Changed

- Import/Export format changed to YAML (old XML exports can still be imported)
- Import/Export the full consentfriend configuration to one file
- Update Klaro! to 0.7.18
- Changing the themes to use the new Klaro vars.scss. If you have created your own theme, please check the display of the consent popup after the update and after compiling the scss file for your site.

### Fixed

- Fix a syntax error in the frontend when the description of a service contains a line feed

## [1.2.2] - 2021-01-02

### Added

- Allow to install \'essential only\' demo data (will install only the session and the consentfriend service)

### Changed

- Don\'t run the license check on the manager login page
- Remove the column menu for the cookies grid

### Fixed

- Fix a missing data-type attribute in a script tag

## [1.2.1] - 2020-12-04

### Fixed

- Fix a not displayed value change in the cookies grid

## [1.2.0] - 2020-12-02

### Added

- Callback code for services
- Enable ACE Editor in ConsentFriend
- Allow the demo data be skipped/installed/updated/replaced on install/update
- `no_autoLoad` system setting, that will keep ConsentFriend from automatically loading itself when the page is being loaded.

### Changed

- Update Klaro! to 0.7.9
- Change the database default values to the used default values

### Fixed

- Fix a not updated/saved value in the cookies grid

### Removed

- Removed `advertisement` service key and translation (changed to `advertising` during an package update)

## [1.1.3] - 2020-11-17

### Added

- Updated/Added strings in the lexicon 

### Fixed

- Fix a missing custom name in the purpose dropdown in the service edit window

## [1.1.2] - 2020-11-11

### Added

- Updated/Added strings in the lexicon 

## [1.1.1] - 2020-11-04

### Added

- Allow context/system settings tags in the service code

### Fixed

- Fix scss files in installed assets

## [1.1.0] - 2020-11-04

### Added

- Import/Export of services and purposes

## [1.0.1] - 2020-10-25

### Changed

- Update Klaro! to 0.6.18

## [1.0.0] - 2020-10-15

### Added

- Public release

## [0.9.0] - 2020-10-02

### Added

- Initial beta release
',
    'setup-options' => 'consentfriend-1.5.3-pl/setup-options.php',
    'requires' => 
    array (
      'php' => '>=7.2',
      'modx' => '>=2.7',
    ),
  ),
  'manifest-vehicles' => 
  array (
    0 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modNamespace',
      'guid' => '3ab1c0320a3eed9c24823ce07bc607d1',
      'native_key' => 'consentfriend',
      'filename' => 'modNamespace/96e5b9510627a68fc493de9e5cb995ff.vehicle',
      'namespace' => 'consentfriend',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modDashboardWidget',
      'guid' => '0f677c479a0f9759af8ea1296652a646',
      'native_key' => NULL,
      'filename' => 'modDashboardWidget/de067ca49d6b6f3362d9efefc45d1bef.vehicle',
      'namespace' => 'consentfriend',
    ),
    2 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e30925d1189d863b03b0a3a4550ed9bd',
      'native_key' => 'consentfriend.debug',
      'filename' => 'modSystemSetting/97dc34e3fbab1e881c88f8fcf83a40d6.vehicle',
      'namespace' => 'consentfriend',
    ),
    3 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e32fa93c8fce5ec59956be266e19862b',
      'native_key' => 'consentfriend.use_contexts',
      'filename' => 'modSystemSetting/014ac63d7e7c6aa1516493fd84780bcb.vehicle',
      'namespace' => 'consentfriend',
    ),
    4 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ee4bf7cacc93598ec3afd72366c9c19c',
      'native_key' => 'consentfriend.enabled_templates',
      'filename' => 'modSystemSetting/aa2f093a948309fbbb0fc2de366e4137.vehicle',
      'namespace' => 'consentfriend',
    ),
    5 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '15f28ab5e63e8dee755d6bd2e168115f',
      'native_key' => 'consentfriend.disabled_templates',
      'filename' => 'modSystemSetting/8b3c844792ecf81114e9a16c65383c78.vehicle',
      'namespace' => 'consentfriend',
    ),
    6 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '8b3632345180f37cf2c9b758f1b0ea11',
      'native_key' => 'consentfriend.css_url',
      'filename' => 'modSystemSetting/a8d73cb7454846d21d6f1b744196893a.vehicle',
      'namespace' => 'consentfriend',
    ),
    7 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '09ca55d535f453b757ec09d2e4d0c147',
      'native_key' => 'consentfriend.js_url',
      'filename' => 'modSystemSetting/8fa16e71226dbaecaefcb5668c93be56.vehicle',
      'namespace' => 'consentfriend',
    ),
    8 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'fddfe40fbdf0bb58151b7e330796a0ca',
      'native_key' => 'consentfriend.privacy_policy_id',
      'filename' => 'modSystemSetting/167e6bda4ffd8a6b9f87c6d55b54a56d.vehicle',
      'namespace' => 'consentfriend',
    ),
    9 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'de660900b55e94c37c4c3d4e6f288c2e',
      'native_key' => 'consentfriend.theme',
      'filename' => 'modSystemSetting/fdcd884760077ec4a5f9b7eff86762e2.vehicle',
      'namespace' => 'consentfriend',
    ),
    10 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b11b9d1e4f134488d7a7927510f4d470',
      'native_key' => 'consentfriend.enable',
      'filename' => 'modSystemSetting/7125f89416ac9a3149cc072e12d95cf0.vehicle',
      'namespace' => 'consentfriend',
    ),
    11 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '80f815558c8e7886a1ae55a1eb155c58',
      'native_key' => 'consentfriend.element_id',
      'filename' => 'modSystemSetting/e36ecbbd0a0e5a1b23cae12b285fcd67.vehicle',
      'namespace' => 'consentfriend',
    ),
    12 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd43838ff1e78e5de2e74113798a44fcf',
      'native_key' => 'consentfriend.no_autoLoad',
      'filename' => 'modSystemSetting/657825ba6d7047043805df23dd9de906.vehicle',
      'namespace' => 'consentfriend',
    ),
    13 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '28ca7569a870f9cf6efcb3841032a643',
      'native_key' => 'consentfriend.html_texts',
      'filename' => 'modSystemSetting/d9e4402a404d8c1eb3a08de45a49bfbd.vehicle',
      'namespace' => 'consentfriend',
    ),
    14 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '26a9c544f3ab02484c8fa9c8169b24d7',
      'native_key' => 'consentfriend.embedded',
      'filename' => 'modSystemSetting/5d4dddb1acc6e7faa40ab9c50c62f7ba.vehicle',
      'namespace' => 'consentfriend',
    ),
    15 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c0f557de25a9d462c8f48b2458d61f53',
      'native_key' => 'consentfriend.group_by_purpose',
      'filename' => 'modSystemSetting/8a6fb24a108c4beffa3389c21ec737aa.vehicle',
      'namespace' => 'consentfriend',
    ),
    16 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4d258b6bc9a84e0de69515e4d556cae7',
      'native_key' => 'consentfriend.storage_method',
      'filename' => 'modSystemSetting/04198f8d428f0556a7a9856a63bc5ccf.vehicle',
      'namespace' => 'consentfriend',
    ),
    17 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4eb7807f7621ce8659f1ade0af53cd73',
      'native_key' => 'consentfriend.default',
      'filename' => 'modSystemSetting/7fcb7c51e8867edbb6e230f4a468a3d1.vehicle',
      'namespace' => 'consentfriend',
    ),
    18 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '700d205efe90e0987dff6904e3368126',
      'native_key' => 'consentfriend.must_consent',
      'filename' => 'modSystemSetting/4123aaee19417f8150a881f33127e07f.vehicle',
      'namespace' => 'consentfriend',
    ),
    19 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'bd6a6d01ff5cbf634f275697a56311da',
      'native_key' => 'consentfriend.accept_all',
      'filename' => 'modSystemSetting/5c89a859935141379296c3039a430a86.vehicle',
      'namespace' => 'consentfriend',
    ),
    20 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3cf183ecf30011f4f5ce6f5423d38d13',
      'native_key' => 'consentfriend.hide_decline_all',
      'filename' => 'modSystemSetting/bf6e551d51bf4b98f42203b2b1ae5a55.vehicle',
      'namespace' => 'consentfriend',
    ),
    21 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '0f4ce8f0a77dd36962c90d96ace0796d',
      'native_key' => 'consentfriend.hide_learn_more',
      'filename' => 'modSystemSetting/eb2c40c96d5dc8206688ba5417608ea8.vehicle',
      'namespace' => 'consentfriend',
    ),
    22 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'fcf14c69edb152213fa0861b65a49a57',
      'native_key' => 'consentfriend.notice_as_modal',
      'filename' => 'modSystemSetting/7ac4d0e86cc48c54d33520f95d4b36b8.vehicle',
      'namespace' => 'consentfriend',
    ),
    23 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '1c37b02557bd5ea3adf6fcaba25ccb78',
      'native_key' => 'consentfriend.hide_powered_by',
      'filename' => 'modSystemSetting/78bfa7bcd6781bd8fc6ccc7d0c6c9eb7.vehicle',
      'namespace' => 'consentfriend',
    ),
    24 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3a19a4a98d92f79d63a7fc846aa8a087',
      'native_key' => 'consentfriend.cookie_name',
      'filename' => 'modSystemSetting/9e54c4869808d39d21c1650580ecba8c.vehicle',
      'namespace' => 'consentfriend',
    ),
    25 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '6668dd8559022f46dff60cc9a79c0e22',
      'native_key' => 'consentfriend.cookie_expires_after_days',
      'filename' => 'modSystemSetting/99d28108df3e2878b2c9b62d46191a4c.vehicle',
      'namespace' => 'consentfriend',
    ),
    26 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '89352830f075c204f6b13b7fcd69a529',
      'native_key' => 'consentfriend.cookie_domain',
      'filename' => 'modSystemSetting/1adff61cf8ab1faa9cbdce9a49cf57a3.vehicle',
      'namespace' => 'consentfriend',
    ),
    27 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '6fe2cd8adec263935b13752dfbb08bc5',
      'native_key' => 'consentfriend.log_usage',
      'filename' => 'modSystemSetting/54fc7a784769d44af1be6b963e15c58b.vehicle',
      'namespace' => 'consentfriend',
    ),
    28 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '34ae69ae46b8024db0eb9f838c28e7d2',
      'native_key' => 'consentfriend.user_agent_filter',
      'filename' => 'modSystemSetting/ff1bedcebc1923cf4358b308c9f6201e.vehicle',
      'namespace' => 'consentfriend',
    ),
    29 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modCategory',
      'guid' => '9a937764d53e812c1bc6280665e180f0',
      'native_key' => NULL,
      'filename' => 'modCategory/3086f0a2efb70f9c87c6a8c9554480a4.vehicle',
      'namespace' => 'consentfriend',
    ),
    30 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modMenu',
      'guid' => 'b99e80f3d8b6440767e1952ca241f171',
      'native_key' => 'consentfriend.menu_home',
      'filename' => 'modMenu/50a4255a8a25cdc4ce8dea38ac910b0a.vehicle',
      'namespace' => 'consentfriend',
    ),
  ),
);