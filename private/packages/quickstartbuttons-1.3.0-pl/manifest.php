<?php return array (
  'manifest-version' => '1.1',
  'manifest-attributes' => 
  array (
    'license' => 'The MIT License (MIT)

Copyright (c) 2014 Bert Oost for modmore

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
SOFTWARE.',
    'readme' => '--------------------------------------------
QuickstartButtons - Managing dashboard quickstart buttons
--------------------------------------------
Author: Bert Oost - support@oostdesign.com
--------------------------------------------

A MODX Revolution 2.2+ dashboard widget to manage quickstart buttons
',
    'changelog' => '++ QuickstartButtons 1.3.0-pl
++ Released on 2020-07-22
+++++++++++++++++++++++++
- Fix installation on InnoDB due to indexes that were too long, and set defaultEngine to InnoDB [#43]
- Replace modAction based routing with namespace routing [#52]
- Prevent persisted XSS in component grids
- Fix selected action not being saved on first create of a button [#41]
- Fix custom icons not showing

++ QuickstartButtons 1.3.0-rc1
++ Released on 2016-03-07
+++++++++++++++++++++++++
- Update to Font Awesome 4.5.0 [#21]
- Make sure icons resolver adds new icons on update
- Fix CSS scoping issue [#35]
- Fix issue loading Font Awesome CSS with compress_css enabled [#20]
- Add missing media/browser action [#34]
- Fix loading actions after save [#31]
- Allow linking to actions with the action key and namespace [#32]
- Fix issue displaying the set name due to caching [#23]

++ QuickstartButtons 1.2.0-pl
++ Released on 2014-04-13
+++++++++++++++++++++++++
- Better design for the latest 2.3 theme (thanks Christian Seel!)

++ QuickstartButtons 1.2.0-rc1
++ Released on 2014-04-09
+++++++++++++++++++++++++
- Update actions dropdown and buttons to link to 2.3-style actions
- Move menu item lower in the top nav to make sure the Installer stays first
- Conditionally load MODX 2.3 specific stylesheet (thanks Tomislav J!)

++ QuickstartButtons 1.1.1-pl
++ Released on 2014-08-04
+++++++++++++++++++++++++
- Give windows an automatic height and fix 2.3 window vtabs styling
- Ensure menu item is created on 2.3 by moving to components

++ QuickstartButtons 1.1.0-pl
++ Released on 2014-05-06
+++++++++++++++++++++++++
- New feature: added customizable icons for buttons (Media Source & File selection)
- New feature: duplicate set (with buttons)

++ QuickstartButtons 1.0.1-pl
++ Released on 2014-03-29
+++++++++++++++++++++++++
- New feature: system action properties passed by string
- Improvement: caching on dashboard widget, per user group names of the user
- Styling issues dashboard buttons fixed (Thanks to @christianseel)
- Fix installing defaults on upgrade

++ QuickstartButtons 1.0.0-pl
++ Released on 2014-03-24
+++++++++++++++++++++++++
- Initial release
',
  ),
  'manifest-vehicles' => 
  array (
    0 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modNamespace',
      'guid' => '9a519f9efbef9ea6c39b34bcd1bb57bf',
      'native_key' => 'quickstartbuttons',
      'filename' => 'modNamespace/62d21ba5566fe29440913192485ec378.vehicle',
      'namespace' => 'quickstartbuttons',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modMenu',
      'guid' => '32888ac1fa3532de531dabde62d52f65',
      'native_key' => 'quickstartbuttons',
      'filename' => 'modMenu/08f82dd87158ec74b2713ce93edd9e71.vehicle',
      'namespace' => 'quickstartbuttons',
    ),
    2 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modDashboardWidget',
      'guid' => '9b89b1131f0dfc427ce8ea631a527b12',
      'native_key' => NULL,
      'filename' => 'modDashboardWidget/f210bb6d05fd8d0e078f8a491dc2f7e9.vehicle',
      'namespace' => 'quickstartbuttons',
    ),
  ),
);