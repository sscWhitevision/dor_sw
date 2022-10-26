<?php return array (
  'manifest-version' => '1.1',
  'manifest-attributes' => 
  array (
    'license' => 'ConsentFriend is proprietary software, developed by Thomas Jakobi for Treehill
Studio. By purchasing ConsentFriend you have received a usage license for one
single MODX Revolution installation, including one year email support (starting
at the day of purchase).

While we hope that ConsentFriend is useful for you and we will try to help you
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
    'setup-options' => 'consentfriend-1.5.1-pl/setup-options.php',
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
      'guid' => 'b20f0dfad0f1b0e73f8dcce455f0c916',
      'native_key' => 'consentfriend',
      'filename' => 'modNamespace/b674427b2c3080ce2977514af2d75dbe.vehicle',
      'namespace' => 'consentfriend',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modDashboardWidget',
      'guid' => 'f34a3636f0ef3a8896ceb40baaab4c62',
      'native_key' => NULL,
      'filename' => 'modDashboardWidget/85a49b9b5d6248c003b5abfc2abd3c25.vehicle',
      'namespace' => 'consentfriend',
    ),
    2 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'cdc876a0200712663027136338f22d66',
      'native_key' => 'consentfriend.debug',
      'filename' => 'modSystemSetting/65e2769a0fe87567acb7e2775eaedf54.vehicle',
      'namespace' => 'consentfriend',
    ),
    3 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '40696085c16d049d9c49b96ac224504a',
      'native_key' => 'consentfriend.use_contexts',
      'filename' => 'modSystemSetting/402a451aa862368d40d061dfd5644b18.vehicle',
      'namespace' => 'consentfriend',
    ),
    4 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '05260675d8888cebfe182dabdc0a3648',
      'native_key' => 'consentfriend.enabled_templates',
      'filename' => 'modSystemSetting/e2e6df3f8524aa97a88571cf38362699.vehicle',
      'namespace' => 'consentfriend',
    ),
    5 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e35b10cb42a0aa1cbf9c3fea3de67c12',
      'native_key' => 'consentfriend.disabled_templates',
      'filename' => 'modSystemSetting/a8b74e122b6ceb90d0eead7ba85faa56.vehicle',
      'namespace' => 'consentfriend',
    ),
    6 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a853b32e9bfc0f1f2d350b99fea1f412',
      'native_key' => 'consentfriend.css_url',
      'filename' => 'modSystemSetting/58ded13fe99d40aded8f207e13ad4948.vehicle',
      'namespace' => 'consentfriend',
    ),
    7 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'bc6ccae902092df21884d3b3b7062049',
      'native_key' => 'consentfriend.js_url',
      'filename' => 'modSystemSetting/244cf6f4eb046dbeef73edc51a0548f8.vehicle',
      'namespace' => 'consentfriend',
    ),
    8 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4953e09d06539c666c1151b77e8631b2',
      'native_key' => 'consentfriend.privacy_policy_id',
      'filename' => 'modSystemSetting/57869ecb189b1f0c7210bac9bdfc4fe5.vehicle',
      'namespace' => 'consentfriend',
    ),
    9 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '440f6bb84f04c8fb2585d2469e77c242',
      'native_key' => 'consentfriend.theme',
      'filename' => 'modSystemSetting/6514f426601f1b05d41db1d706880ed7.vehicle',
      'namespace' => 'consentfriend',
    ),
    10 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '03b225795a152d038c47c5fd6d1e8a3c',
      'native_key' => 'consentfriend.enable',
      'filename' => 'modSystemSetting/5001ea09906ca7eed6123e7e771bcdd7.vehicle',
      'namespace' => 'consentfriend',
    ),
    11 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '1acfb0f92c43a2bbdeaec78a6c61ead6',
      'native_key' => 'consentfriend.element_id',
      'filename' => 'modSystemSetting/8b655f57bbfaa99cc8aff0c74e0e94af.vehicle',
      'namespace' => 'consentfriend',
    ),
    12 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4d263d8cc744618a4cf64c9940f9ffe5',
      'native_key' => 'consentfriend.no_autoLoad',
      'filename' => 'modSystemSetting/97dea3fdf24b6386d2bd2299c83b26f6.vehicle',
      'namespace' => 'consentfriend',
    ),
    13 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd92eba5afc8a2f859f7ff16600e384ce',
      'native_key' => 'consentfriend.html_texts',
      'filename' => 'modSystemSetting/db7b27f307915659280c1ad27fdefbd3.vehicle',
      'namespace' => 'consentfriend',
    ),
    14 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '30a365c8cdfc778137bbf55d2ea6518d',
      'native_key' => 'consentfriend.embedded',
      'filename' => 'modSystemSetting/2150d4e69269731d0e1a486e76157f7c.vehicle',
      'namespace' => 'consentfriend',
    ),
    15 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd4effebc8103c6a5343ea6efb77ad814',
      'native_key' => 'consentfriend.group_by_purpose',
      'filename' => 'modSystemSetting/bcceb7b78ae5a68b9f0e7b0d864c9dc7.vehicle',
      'namespace' => 'consentfriend',
    ),
    16 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e0435131215ef89544de685d0c493e06',
      'native_key' => 'consentfriend.storage_method',
      'filename' => 'modSystemSetting/2a7970f3a3846967c56091e5fa0dc99f.vehicle',
      'namespace' => 'consentfriend',
    ),
    17 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '67265797367ff4d191f16b2289703585',
      'native_key' => 'consentfriend.default',
      'filename' => 'modSystemSetting/f0171847a3055d414e1353a32061cdab.vehicle',
      'namespace' => 'consentfriend',
    ),
    18 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3ac7a509ce6c5d7401bbdce2cf6333b9',
      'native_key' => 'consentfriend.must_consent',
      'filename' => 'modSystemSetting/3ebb1bf53df331f0d34c24a748a2dc76.vehicle',
      'namespace' => 'consentfriend',
    ),
    19 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '8ccfbb906469519d6249d70f8a3c8e70',
      'native_key' => 'consentfriend.accept_all',
      'filename' => 'modSystemSetting/7cd9c56de799f316df7b9f041005d465.vehicle',
      'namespace' => 'consentfriend',
    ),
    20 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '9bf120992300e202d1db752942547606',
      'native_key' => 'consentfriend.hide_decline_all',
      'filename' => 'modSystemSetting/6c53c2dea664f4fece9da14991579963.vehicle',
      'namespace' => 'consentfriend',
    ),
    21 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b03c9c6511ecc0d0e2e69c0f32d00466',
      'native_key' => 'consentfriend.hide_learn_more',
      'filename' => 'modSystemSetting/894a7e89962e7af4749affe0230d4100.vehicle',
      'namespace' => 'consentfriend',
    ),
    22 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3ca28293662be99562d7fe805e7ee684',
      'native_key' => 'consentfriend.notice_as_modal',
      'filename' => 'modSystemSetting/961560a0bd1f23c018cf9af5a1ad3211.vehicle',
      'namespace' => 'consentfriend',
    ),
    23 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'da34367cbc511ee9624a50045b91cdbc',
      'native_key' => 'consentfriend.hide_powered_by',
      'filename' => 'modSystemSetting/ccda74a7451d41a2ec13c018f99632cd.vehicle',
      'namespace' => 'consentfriend',
    ),
    24 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '1f1925ba1628c9e5c93fa0c353d88768',
      'native_key' => 'consentfriend.cookie_name',
      'filename' => 'modSystemSetting/e049bc6e17fbd3b4e741f161dce669f7.vehicle',
      'namespace' => 'consentfriend',
    ),
    25 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'fca73deb11d65d89d4295533fa8230e7',
      'native_key' => 'consentfriend.cookie_expires_after_days',
      'filename' => 'modSystemSetting/80da990aa71e18c54ce5f969eb36a960.vehicle',
      'namespace' => 'consentfriend',
    ),
    26 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a100baa76b93a3c67eeeaae158c7549f',
      'native_key' => 'consentfriend.cookie_domain',
      'filename' => 'modSystemSetting/4eb5fa892cc0ff656b20060fa8bb35d4.vehicle',
      'namespace' => 'consentfriend',
    ),
    27 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '5d875206b0dae41ad5ca721bb6ec8fa0',
      'native_key' => 'consentfriend.log_usage',
      'filename' => 'modSystemSetting/5a6f73b71dfd6b56d872e5c56e633f93.vehicle',
      'namespace' => 'consentfriend',
    ),
    28 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd9ee44635df465379b6be9b6e745dff0',
      'native_key' => 'consentfriend.user_agent_filter',
      'filename' => 'modSystemSetting/c0e400892eb0f6303ccc03d0dec63e1e.vehicle',
      'namespace' => 'consentfriend',
    ),
    29 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modCategory',
      'guid' => 'f42701a077e701069a819f591a4e2f0c',
      'native_key' => NULL,
      'filename' => 'modCategory/d9688d73e88332e5219f15138ca10efa.vehicle',
      'namespace' => 'consentfriend',
    ),
    30 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modMenu',
      'guid' => 'a8e9cd6949b24878a7d30628caaf3dbe',
      'native_key' => 'consentfriend.menu_home',
      'filename' => 'modMenu/4bba9131f21633ea4ab0ce1873268d72.vehicle',
      'namespace' => 'consentfriend',
    ),
  ),
);