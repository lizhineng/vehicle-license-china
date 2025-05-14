# Vehicle license library for mainland China

[![MIT License](https://img.shields.io/packagist/l/lizhineng/vehicle-license-china)](https://github.com/lizhineng/vehicle-license-china)
[![Tests](https://github.com/lizhineng/vehicle-license-china/actions/workflows/test.yml/badge.svg)](https://github.com/lizhineng/vehicle-license-china/actions/workflows/test.yml)
[![Downloads](https://img.shields.io/packagist/dt/lizhineng/vehicle-license-china)](https://github.com/lizhineng/vehicle-license-china/actions/workflows/test.yml)

The library implements the [GA 36-2018], which helps you validate the vehicle
registration number issued in mainland China and extract the information
from the plate number.

## Install

The package can be installed through Composer and requires PHP 8.4+

```bash
composer require lizhineng/vehicle-license-china
```

## Usage

You can easily create an instance of a registration number with the `make`
factory method. All validation will be checked against the plate number
before initialization; otherwise, a _RegistrationNumberException_ will be
thrown.

```php
use Zhineng\VehicleLicenseChina\RegistrationNumber;
use Zhineng\VehicleLicenseChina\RegistrationNumberException;

try {
    $registrationNumber = RegistrationNumber::make('粤E12345');
} catch (RegistrationNumberException $e) {
    // The registration number is invalid.
}
```

The library supports all vehicle types defined in the standard: embassy,
consulate, police, coach, trailer, Hong Kong, Macau, test, and special
vehicles.

```php
$registrationNumber->isEmbassy();
$registrationNumber->isConsulate();
$registrationNumber->isPolice();
$registrationNumber->isCoach();
$registrationNumber->isTrailer();
$registrationNumber->isFromHongKong();
$registrationNumber->isFromMacau();
$registrationNumber->isTest();
$registrationNumber->isSpecial();
```

To differentiate clean energy vehicles, note that these plate numbers apply
only to those without any suffix.

```php
$registrationNumber->isCleanEnergy();

// Check if it's a small clean energy vehicle
$registrationNumber->isSmallCleanEnergy();

// Check if it's a large clean energy vehicle
$registrationNumber->isLargeCleanEnergy();
```

You can further specify if a clean energy vehicle is entirely powered by
electricity.

```php
$registrationNumber->isBatteryElectric();
```

## License

The library is licensed under [the MIT license].

[GA 36-2018]: https://std.samr.gov.cn/hb/search/stdHBDetailed?id=8B1827F150C5BB19E05397BE0A0AB44A
[the MIT license]: LICENSE.md
