# Changelog

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

- Don't allow invalid MODX lexicon strings to break the Klaro lexicon

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
- Additional 'consentfriend-' prefix for css variables
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

- Allow to install 'essential only' demo data (will install only the session and the consentfriend service)

### Changed

- Don't run the license check on the manager login page
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
