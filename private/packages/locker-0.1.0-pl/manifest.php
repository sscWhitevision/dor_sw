<?php return array (
  'manifest-version' => '1.1',
  'manifest-attributes' => 
  array (
    'license' => '# The MIT License

Copyright © 2015 Melting Media <hello+locker@melting-media.com>

> Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
> documentation files (the “Software”), to deal in the Software without restriction, including without limitation the
> rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit
> persons to whom the Software is furnished to do so, subject to the following conditions:
> 
> The above copyright notice and this permission notice shall be included in all copies or substantial portions of the
> Software.
> 
> THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
> WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NON INFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
> COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
> OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
',
    'readme' => '# Locker

An helper to lock users out of the Revolution manager.

Locker was PoC\'ed at [MODXCCC2015](https://github.com/modx-ccc-2015)


## Goals

Prevent login into the manager when planning some maintenance (backup, migration...).


## Requirements

* PHP 5.3+
* MODX Revolution 2.3+


## Installation

1. Download and install the transport package
2. Head over system settings to tweak to your needs

You should be ready to go!


## Bug reports

Head over <https://github.com/meltingmedia/Locker/issues>


## License

Locker is licensed under the [MIT license](LICENSE.md).
Copyright 2015 Melting Media <https://github.com/meltingmedia>
',
    'changelog' => '# Changelog

Changes for Locker component.


## 0.1.0-pl (2015/02/13)

* First release
',
  ),
  'manifest-vehicles' => 
  array (
    0 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modNamespace',
      'guid' => '7b3e0d22c489abf8efe61c6797a538cd',
      'native_key' => 'locker',
      'filename' => 'modNamespace/6cc8395f385a8118bef879e44c27f564.vehicle',
      'namespace' => 'locker',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modCategory',
      'guid' => '4c37497e69e499da3f449242ed8149a7',
      'native_key' => 1,
      'filename' => 'modCategory/bb81849e120e8aeceaf03699074f413c.vehicle',
      'namespace' => 'locker',
    ),
    2 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '1338822ab80edcb2c3c10ea5d84666f0',
      'native_key' => 'locker.flush_sessions_on_lock',
      'filename' => 'modSystemSetting/28092e0601751d477e8bfd883dd700c9.vehicle',
      'namespace' => 'locker',
    ),
    3 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '1e450fdc732fb3bd7da41515049159c8',
      'native_key' => 'locker.locked',
      'filename' => 'modSystemSetting/bfa59e1364e59e29f815aed850ef4f49.vehicle',
      'namespace' => 'locker',
    ),
    4 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'fb6f0fa1bb4e412657b58a13e626ac29',
      'native_key' => 'locker.status_off_on_lock',
      'filename' => 'modSystemSetting/518c1608bbe88719951eed95808b57ea.vehicle',
      'namespace' => 'locker',
    ),
  ),
);