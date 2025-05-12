<?php

declare(strict_types=1);

namespace Zhineng\VehicleLicenseChina\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Zhineng\VehicleLicenseChina\RegistrationNumber;
use Zhineng\VehicleLicenseChina\RegistrationNumberException;

#[CoversClass(RegistrationNumber::class)]
final class RegistrationNumberTest extends TestCase
{
    #[DataProvider('provide_valid_registration_numbers')]
    #[DataProvider('provide_valid_clean_energy_registration_numbers')]
    public function test_valid_registration_number(string $registrationNumber): void
    {
        $instance = RegistrationNumber::make($registrationNumber);
        $this->assertSame($registrationNumber, $instance->registrationNumber);
    }

    #[DataProvider('provide_invalid_registration_numbers')]
    #[DataProvider('provide_invalid_clean_energy_registration_numbers')]
    public function test_invalid_registration_number(string $registrationNumber): void
    {
        $this->expectException(RegistrationNumberException::class);
        $this->expectExceptionMessage(sprintf('The registration number "%s" is invalid.', $registrationNumber));
        RegistrationNumber::make($registrationNumber);
    }

    public function test_is_clean_energy_determines_if_vehicle_is_clean_energy(): void
    {
        $this->assertTrue(RegistrationNumber::make('粤ED12345')->isCleanEnergy());
        $this->assertFalse(RegistrationNumber::make('粤ED1234')->isCleanEnergy());
    }

    public function test_is_battery_electric_determines_if_vehicle_is_a_fully_electric_vehicle(): void
    {
        $this->assertTrue(RegistrationNumber::make('粤ED12345')->isBatteryElectric());
        $this->assertTrue(RegistrationNumber::make('粤EA12345')->isBatteryElectric());
        $this->assertTrue(RegistrationNumber::make('粤EB12345')->isBatteryElectric());
        $this->assertTrue(RegistrationNumber::make('粤EC12345')->isBatteryElectric());
        $this->assertTrue(RegistrationNumber::make('粤EE12345')->isBatteryElectric());
        $this->assertFalse(RegistrationNumber::make('粤EF12345')->isBatteryElectric());
        $this->assertFalse(RegistrationNumber::make('粤EG12345')->isBatteryElectric());
        $this->assertFalse(RegistrationNumber::make('粤EH12345')->isBatteryElectric());
        $this->assertFalse(RegistrationNumber::make('粤EJ12345')->isBatteryElectric());
        $this->assertFalse(RegistrationNumber::make('粤EK12345')->isBatteryElectric());
    }

    /**
     * @return string[]
     */
    public static function provide_valid_registration_numbers(): array
    {
        return [
            ['粤E1234'],
            ['粤EA123'],
            ['粤E1A23'],
            ['粤E12A3'],
            ['粤E123A'],
            ['粤EAB12'],
            ['粤E12AB'],
            ['粤E1AB2'],
            ['粤E1A2B'],
            ['粤EA12B'],
            ['粤EA1B2'],
            ['粤E12345'],
            ['粤EA1234'],
            ['粤E1A234'],
            ['粤E12A34'],
            ['粤E123A4'],
            ['粤E1234A'],

            // Authority code "O" (the 2nd character) is for internal
            ['粤O12345'],

            // Authority code "Z" (the 2nd character) is for internal in Guangdong province
            ['粤Z12345'],

            // Authority code "W" (the 2nd character) is for internal in Shandong province
            ['鲁W12345'],
        ];
    }

    /**
     * @return string[]
     */
    public static function provide_valid_clean_energy_registration_numbers(): array
    {
        return [
            ['粤ED12345'],
            ['粤EDA1234'],

            // Authority code "O" (the 2nd character) is for internal
            ['粤OD12345'],

            // Authority code "Z" (the 2nd character) is for internal in Guangdong province
            ['粤ZD12345'],

            // Authority code "W" (the 2nd character) is for internal in Shandong province
            ['鲁WD12345'],
        ];
    }

    /**
     * @return string[]
     */
    public static function provide_invalid_registration_numbers(): array
    {
        return [
            ['假E12345'],
            ['粤I12345'],
            ['粤EABC1'],
            ['粤E123+'],
            ['粤E1234+'],
            ['粤EABC12'],

            // Sequence could not contain "O" or "I"
            ['粤EO123'],
            ['粤E1O23'],
            ['粤E12O3'],
            ['粤E123O'],
            ['粤EI123'],
            ['粤E1I23'],
            ['粤E12I3'],
            ['粤E123I'],
            ['粤EO1234'],
            ['粤E1O234'],
            ['粤E12O34'],
            ['粤E123O4'],
            ['粤E1234O'],
            ['粤EI1234'],
            ['粤E1I234'],
            ['粤E12I34'],
            ['粤E123I4'],
            ['粤E1234I'],
        ];
    }

    /**
     * @return string[]
     */
    public static function provide_invalid_clean_energy_registration_numbers(): array
    {
        return [
            ['粤ED1A234'],
            ['粤ED12A34'],
            ['粤ED123A4'],
            ['粤ED1234A'],
            ['粤EZ12345'],
            ['粤ED1234+'],

            // Sequence could not contain "O" or "I"
            ['粤EDO1234'],
            ['粤EDI1234'],
        ];
    }
}
