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

MODX consent management platform

- Author: Thomas Jakobi <thomas.jakobi@partout.info>
- License: Proprietary

# Features

ConsentFriend informs each visitor which services the MODX site would like to
use. Each service usage can be accepted/denied. A link to the privacy policy
of the site can be displayed. The javascript for the consent management is
based on Klaro! (by KIProtect GmbH).

## Installation

MODX Package Management

## Documentation

The ConsentFriend Plugin outputs the ConsentFriend options and the self hosted javascript
code at the start of the head section.

See the description of the system settings for other options.

## Translations

Translations of ConsentFriend can be made on [Weblate](https://hosted.weblate.org/projects/modx-consentfriend/)

## Third party licenses

This extra includes third party software, for which we are thankful.

- Klaro (by KIProtect GmbH) (kiprotect.com/klaro), BSD 3-Clause License (core/components/consentfriend/docs/klaro-license.txt).
 ',
    'changelog' => '# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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
    'setup-options' => 'consentfriend-1.3.3-pl/setup-options.php',
    'requires' => 
    array (
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
      'guid' => 'dd923694150ca4173852e3451b157125',
      'native_key' => 'consentfriend',
      'filename' => 'modNamespace/b7a20a72c3f2f1364f9cc3435ca9c2b5.vehicle',
      'namespace' => 'consentfriend',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ffcc328db8794d7e0f8f91c669d29e2e',
      'native_key' => 'consentfriend.debug',
      'filename' => 'modSystemSetting/f5e081c91c43af1c5793e945c775e9a3.vehicle',
      'namespace' => 'consentfriend',
    ),
    2 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '345043d44f33f27a43c2f81f39793710',
      'native_key' => 'consentfriend.css_url',
      'filename' => 'modSystemSetting/c9c0138e7bba57681f924d5a55ede6a0.vehicle',
      'namespace' => 'consentfriend',
    ),
    3 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '11fb528294d03a6ee156d186c0bbcd25',
      'native_key' => 'consentfriend.js_url',
      'filename' => 'modSystemSetting/6470ccaf9b96953c4cdb530cf0b13bbc.vehicle',
      'namespace' => 'consentfriend',
    ),
    4 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c476d64fcdba658d82a9851112b16238',
      'native_key' => 'consentfriend.privacy_policy_id',
      'filename' => 'modSystemSetting/672d308d8c3b8926a8f7a79041fefb58.vehicle',
      'namespace' => 'consentfriend',
    ),
    5 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3f9f2d826cbd7cef949e3f9e1c6ffa07',
      'native_key' => 'consentfriend.enable',
      'filename' => 'modSystemSetting/ba08a086339da0bb28349a081a32971a.vehicle',
      'namespace' => 'consentfriend',
    ),
    6 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a5988d2823297dde10493589c7028489',
      'native_key' => 'consentfriend.element_id',
      'filename' => 'modSystemSetting/9c79bbb671dd57dc7838777e59079110.vehicle',
      'namespace' => 'consentfriend',
    ),
    7 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '874e3c9b7ed74ef7706e5230bc6014eb',
      'native_key' => 'consentfriend.no_autoLoad',
      'filename' => 'modSystemSetting/001781cf83303410c8abeba7641f9d9c.vehicle',
      'namespace' => 'consentfriend',
    ),
    8 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b0955aefebe808040bf7da97141875b1',
      'native_key' => 'consentfriend.html_texts',
      'filename' => 'modSystemSetting/92ec7dc1a3505badf4d80a280ff57716.vehicle',
      'namespace' => 'consentfriend',
    ),
    9 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '7dc03d29a428810c1cb1effb744815f4',
      'native_key' => 'consentfriend.embedded',
      'filename' => 'modSystemSetting/3651acca9071c4bf250590e33691e2c1.vehicle',
      'namespace' => 'consentfriend',
    ),
    10 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'aa94e06e61d8abb2b4490c6eb5fbecc5',
      'native_key' => 'consentfriend.group_by_purpose',
      'filename' => 'modSystemSetting/ede2c96d06e12261b40911d148e513b3.vehicle',
      'namespace' => 'consentfriend',
    ),
    11 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'aee47be7f9cb52d0c791417d8c2555b4',
      'native_key' => 'consentfriend.storage_method',
      'filename' => 'modSystemSetting/daf90256746b5859f181e92c33b20141.vehicle',
      'namespace' => 'consentfriend',
    ),
    12 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '86e957f3678ba7e1b70f721024cb33bc',
      'native_key' => 'consentfriend.cookie_name',
      'filename' => 'modSystemSetting/691963992edbc2c3e125b5b650824e97.vehicle',
      'namespace' => 'consentfriend',
    ),
    13 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd55fe6a4b66499e57cd08a80fd6c4b2e',
      'native_key' => 'consentfriend.cookie_expires_after_days',
      'filename' => 'modSystemSetting/313424970c280c04090ab03fd829b46d.vehicle',
      'namespace' => 'consentfriend',
    ),
    14 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b0475305c5a38b12fb57b1d33cdccecb',
      'native_key' => 'consentfriend.cookie_domain',
      'filename' => 'modSystemSetting/c44516ccca56a555f9fbdecfa81781ca.vehicle',
      'namespace' => 'consentfriend',
    ),
    15 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a42eb9d6a8b1f2be622009d8990c03ef',
      'native_key' => 'consentfriend.default',
      'filename' => 'modSystemSetting/adc96a8e7bae96a898b25384090fd454.vehicle',
      'namespace' => 'consentfriend',
    ),
    16 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'edd0e22886031a5a9d3ed23f2b0452f7',
      'native_key' => 'consentfriend.must_consent',
      'filename' => 'modSystemSetting/079f03b4f3171e0d5b1cf16cef86d2a5.vehicle',
      'namespace' => 'consentfriend',
    ),
    17 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '2efd7bd948a65c02cac4a49c622b6c75',
      'native_key' => 'consentfriend.accept_all',
      'filename' => 'modSystemSetting/6b893efeb98fc79bf054fcf50dc088f7.vehicle',
      'namespace' => 'consentfriend',
    ),
    18 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'cb46a30cbc88c480262e0bffbe907ff2',
      'native_key' => 'consentfriend.hide_decline_all',
      'filename' => 'modSystemSetting/9fc456d5c2ab58b2740ef01ab926c1e0.vehicle',
      'namespace' => 'consentfriend',
    ),
    19 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '61a5b1a3a577e730abe9e94eb5a32999',
      'native_key' => 'consentfriend.hide_learn_more',
      'filename' => 'modSystemSetting/d9fca568d386e394cf187e3c5f6d7084.vehicle',
      'namespace' => 'consentfriend',
    ),
    20 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '7132b5a71ecb762e600158be0211f713',
      'native_key' => 'consentfriend.notice_as_modal',
      'filename' => 'modSystemSetting/10948491e5288075d3bdba005a6773d4.vehicle',
      'namespace' => 'consentfriend',
    ),
    21 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd00aa362a96ff922e0e986612a130fd7',
      'native_key' => 'consentfriend.hide_powered_by',
      'filename' => 'modSystemSetting/2233bebc0804c121a694a4748c4a5cdf.vehicle',
      'namespace' => 'consentfriend',
    ),
    22 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd8d3fbfdbb79f7564e1c5d0b6d5b5858',
      'native_key' => 'consentfriend.theme',
      'filename' => 'modSystemSetting/98c564f61065e6453023db7f08942f71.vehicle',
      'namespace' => 'consentfriend',
    ),
    23 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modCategory',
      'guid' => '3e3f379b1f486ab3a13149b97603ce34',
      'native_key' => NULL,
      'filename' => 'modCategory/08445598122e2cb8cd74b1b0a207938f.vehicle',
      'namespace' => 'consentfriend',
    ),
    24 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modMenu',
      'guid' => '86fb8fecca17e8a42bce1c87976a8e99',
      'native_key' => 'consentfriend.menu_home',
      'filename' => 'modMenu/06610f63f0437852e8e2b3320d1436a5.vehicle',
      'namespace' => 'consentfriend',
    ),
  ),
);