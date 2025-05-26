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
    #[DataProvider('provide_valid_large_clean_energy_vehicle_registration_numbers')]
    #[DataProvider('provide_valid_special_registration_numbers')]
    #[DataProvider('provide_valid_embassy_registration_numbers')]
    #[DataProvider('provide_valid_consulate_registration_numbers')]
    public function test_valid_registration_number(string $registrationNumber): void
    {
        $instance = RegistrationNumber::make($registrationNumber);
        $this->assertSame($registrationNumber, $instance->registrationNumber);
    }

    #[DataProvider('provide_invalid_registration_numbers')]
    #[DataProvider('provide_invalid_clean_energy_registration_numbers')]
    #[DataProvider('provide_invalid_large_clean_energy_vehicle_registration_numbers')]
    #[DataProvider('provide_invalid_special_registration_numbers')]
    #[DataProvider('provide_invalid_embassy_registration_numbers')]
    #[DataProvider('provide_invalid_consulate_registration_numbers')]
    public function test_invalid_registration_number(string $registrationNumber): void
    {
        $this->expectException(RegistrationNumberException::class);
        $this->expectExceptionMessage(sprintf('The registration number "%s" is invalid.', $registrationNumber));
        RegistrationNumber::make($registrationNumber);
    }

    public function test_embassy_vehicle_registration_number(): void
    {
        $number = RegistrationNumber::make('224578使');
        $this->assertSame('224', $number->agencyNumber);
        $this->assertSame('578', $number->sequence);
        $this->assertSame('使', $number->suffix);
        $this->assertSame('', $number->region);
        $this->assertSame('', $number->authority);
    }

    public function test_consulate_vehicle_registration_number(): void
    {
        $number = RegistrationNumber::make('沪22478领');
        $this->assertSame('沪', $number->region);
        $this->assertSame('224', $number->agencyNumber);
        $this->assertSame('78', $number->sequence);
        $this->assertSame('领', $number->suffix);
        $this->assertSame('', $number->authority);
    }

    public function test_police_vehicle_registration_number(): void
    {
        $number = RegistrationNumber::make('京A0006警');
        $this->assertSame('京', $number->region);
        $this->assertSame('A', $number->authority);
        $this->assertSame('0006', $number->sequence);
        $this->assertSame('警', $number->suffix);
        $this->assertSame('', $number->agencyNumber);
    }

    public function test_coach_vehicle_registration_number(): void
    {
        $number = RegistrationNumber::make('粤E12345学');
        $this->assertSame('粤', $number->region);
        $this->assertSame('E', $number->authority);
        $this->assertSame('12345', $number->sequence);
        $this->assertSame('学', $number->suffix);
        $this->assertSame('', $number->agencyNumber);
    }

    public function test_trailer_registration_number(): void
    {
        $number = RegistrationNumber::make('粤E12345挂');
        $this->assertSame('粤', $number->region);
        $this->assertSame('E', $number->authority);
        $this->assertSame('12345', $number->sequence);
        $this->assertSame('挂', $number->suffix);
        $this->assertSame('', $number->agencyNumber);
    }

    public function test_hong_kong_vehicle_registration_number(): void
    {
        $number = RegistrationNumber::make('粤Z1234港');
        $this->assertSame('粤', $number->region);
        $this->assertSame('Z', $number->authority);
        $this->assertSame('1234', $number->sequence);
        $this->assertSame('港', $number->suffix);
        $this->assertSame('', $number->agencyNumber);
    }

    public function test_macau_vehicle_registration_number(): void
    {
        $number = RegistrationNumber::make('粤Z1234澳');
        $this->assertSame('粤', $number->region);
        $this->assertSame('Z', $number->authority);
        $this->assertSame('1234', $number->sequence);
        $this->assertSame('澳', $number->suffix);
        $this->assertSame('', $number->agencyNumber);
    }

    public function test_test_vehicle_registration_number(): void
    {
        $number = RegistrationNumber::make('粤E12345试');
        $this->assertSame('粤', $number->region);
        $this->assertSame('E', $number->authority);
        $this->assertSame('12345', $number->sequence);
        $this->assertSame('试', $number->suffix);
        $this->assertSame('', $number->agencyNumber);
    }

    public function test_special_vehicle_registration_number(): void
    {
        $number = RegistrationNumber::make('粤E12345超');
        $this->assertSame('粤', $number->region);
        $this->assertSame('E', $number->authority);
        $this->assertSame('12345', $number->sequence);
        $this->assertSame('超', $number->suffix);
        $this->assertSame('', $number->agencyNumber);
    }

    public function test_is_embassy_deteremins_if_registration_number_is_used_by_embassies(): void
    {
        $this->assertTrue(RegistrationNumber::make('224578使')->isEmbassy());
        $this->assertFalse(RegistrationNumber::make('沪22478领')->isEmbassy());
    }

    public function test_is_consulate_determines_if_registration_number_is_used_by_consulates(): void
    {
        $this->assertTrue(RegistrationNumber::make('沪22478领')->isConsulate());
        $this->assertFalse(RegistrationNumber::make('224578使')->isConsulate());
    }

    public function test_is_police_determines_if_registration_number_is_used_by_police_officers(): void
    {
        $this->assertTrue(RegistrationNumber::make('京A0006警')->isPolice());
        $this->assertFalse(RegistrationNumber::make('粤E12345学')->isPolice());
    }

    public function test_is_coach_determines_if_registration_number_is_used_by_coaches(): void
    {
        $this->assertTrue(RegistrationNumber::make('粤E12345学')->isCoach());
        $this->assertFalse(RegistrationNumber::make('粤E12345挂')->isCoach());
    }

    public function test_is_trailer_determines_if_registration_number_is_used_by_trailers(): void
    {
        $this->assertTrue(RegistrationNumber::make('粤E12345挂')->isTrailer());
        $this->assertFalse(RegistrationNumber::make('粤E12345学')->isTrailer());
    }

    public function test_is_from_hong_kong_determines_if_registration_number_is_used_by_hong_kong_drivers(): void
    {
        $this->assertTrue(RegistrationNumber::make('粤Z1234港')->isFromHongKong());
        $this->assertTrue(RegistrationNumber::make('粤Z12345港')->isFromHongKong());
        $this->assertFalse(RegistrationNumber::make('粤Z1234澳')->isFromHongKong());
        $this->assertFalse(RegistrationNumber::make('粤Z12345澳')->isFromHongKong());
    }

    public function test_is_from_macau_determines_if_registration_number_is_used_by_macau_drivers(): void
    {
        $this->assertTrue(RegistrationNumber::make('粤Z1234澳')->isFromMacau());
        $this->assertTrue(RegistrationNumber::make('粤Z12345澳')->isFromMacau());
        $this->assertFalse(RegistrationNumber::make('粤Z1234港')->isFromMacau());
        $this->assertFalse(RegistrationNumber::make('粤Z12345港')->isFromMacau());
    }

    public function test_is_test_determines_if_registration_number_is_used_by_test_vehicles(): void
    {
        $this->assertTrue(RegistrationNumber::make('粤E12345试')->isTest());
        $this->assertFalse(RegistrationNumber::make('粤E12345学')->isTest());
    }

    public function test_is_special_determines_if_registration_number_is_used_by_special_vehicles(): void
    {
        $this->assertTrue(RegistrationNumber::make('粤E12345超')->isSpecial());
        $this->assertFalse(RegistrationNumber::make('粤E12345学')->isSpecial());
    }

    public function test_is_clean_energy_determines_if_vehicle_is_clean_energy(): void
    {
        $this->assertTrue(RegistrationNumber::make('粤ED12345')->isCleanEnergy());
        $this->assertFalse(RegistrationNumber::make('粤ED1234')->isCleanEnergy());
        $this->assertFalse(RegistrationNumber::make('粤Z1234港')->isCleanEnergy());
        $this->assertFalse(RegistrationNumber::make('224578使')->isCleanEnergy());
    }

    public function test_is_battery_electric_determines_if_small_vehicle_is_a_fully_electric_vehicle(): void
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

    public function test_is_battery_electric_determines_if_large_vehicle_is_a_fully_electric_vehicle(): void
    {
        $this->assertTrue(RegistrationNumber::make('粤E12345D')->isBatteryElectric());
        $this->assertTrue(RegistrationNumber::make('粤E12345A')->isBatteryElectric());
        $this->assertTrue(RegistrationNumber::make('粤E12345B')->isBatteryElectric());
        $this->assertTrue(RegistrationNumber::make('粤E12345C')->isBatteryElectric());
        $this->assertTrue(RegistrationNumber::make('粤E12345E')->isBatteryElectric());

        $this->assertFalse(RegistrationNumber::make('粤E12345F')->isBatteryElectric());
        $this->assertFalse(RegistrationNumber::make('粤E12345G')->isBatteryElectric());
        $this->assertFalse(RegistrationNumber::make('粤E12345H')->isBatteryElectric());
        $this->assertFalse(RegistrationNumber::make('粤E12345J')->isBatteryElectric());
        $this->assertFalse(RegistrationNumber::make('粤E12345K')->isBatteryElectric());
    }

    public function test_is_small_clean_energy_determines_if_vehicle_is_small_vehicle_with_clean_energy(): void
    {
        $this->assertTrue(RegistrationNumber::make('粤ED12345')->isSmallCleanEnergy());
        $this->assertTrue(RegistrationNumber::make('粤EA12345')->isSmallCleanEnergy());
        $this->assertTrue(RegistrationNumber::make('粤EB12345')->isSmallCleanEnergy());
        $this->assertTrue(RegistrationNumber::make('粤EC12345')->isSmallCleanEnergy());
        $this->assertTrue(RegistrationNumber::make('粤EE12345')->isSmallCleanEnergy());
        $this->assertTrue(RegistrationNumber::make('粤EF12345')->isSmallCleanEnergy());
        $this->assertTrue(RegistrationNumber::make('粤EG12345')->isSmallCleanEnergy());

        $this->assertFalse(RegistrationNumber::make('粤E12345D')->isSmallCleanEnergy());
        $this->assertFalse(RegistrationNumber::make('粤E12345A')->isSmallCleanEnergy());
        $this->assertFalse(RegistrationNumber::make('粤E12345B')->isSmallCleanEnergy());
        $this->assertFalse(RegistrationNumber::make('粤E12345C')->isSmallCleanEnergy());
        $this->assertFalse(RegistrationNumber::make('粤E12345E')->isSmallCleanEnergy());
        $this->assertFalse(RegistrationNumber::make('粤E12345F')->isSmallCleanEnergy());
        $this->assertFalse(RegistrationNumber::make('粤E12345G')->isSmallCleanEnergy());
    }

    public function test_is_large_clean_energy_determines_if_vehicle_is_large_vehicle_with_clean_energy(): void
    {
        $this->assertTrue(RegistrationNumber::make('粤E12345D')->isLargeCleanEnergy());
        $this->assertTrue(RegistrationNumber::make('粤E12345A')->isLargeCleanEnergy());
        $this->assertTrue(RegistrationNumber::make('粤E12345B')->isLargeCleanEnergy());
        $this->assertTrue(RegistrationNumber::make('粤E12345C')->isLargeCleanEnergy());
        $this->assertTrue(RegistrationNumber::make('粤E12345E')->isLargeCleanEnergy());
        $this->assertTrue(RegistrationNumber::make('粤E12345F')->isLargeCleanEnergy());
        $this->assertTrue(RegistrationNumber::make('粤E12345G')->isLargeCleanEnergy());

        $this->assertFalse(RegistrationNumber::make('粤ED12345')->isLargeCleanEnergy());
        $this->assertFalse(RegistrationNumber::make('粤EA12345')->isLargeCleanEnergy());
        $this->assertFalse(RegistrationNumber::make('粤EB12345')->isLargeCleanEnergy());
        $this->assertFalse(RegistrationNumber::make('粤EC12345')->isLargeCleanEnergy());
        $this->assertFalse(RegistrationNumber::make('粤EE12345')->isLargeCleanEnergy());
        $this->assertFalse(RegistrationNumber::make('粤EF12345')->isLargeCleanEnergy());
        $this->assertFalse(RegistrationNumber::make('粤EG12345')->isLargeCleanEnergy());
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
     * @return string[][]
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
     * @return string[][]
     */
    public static function provide_valid_large_clean_energy_vehicle_registration_numbers(): array
    {
        return [
            // Battery electric vehicle
            ['粤E12345D'],
            ['粤E12345A'],
            ['粤E12345B'],
            ['粤E12345C'],
            ['粤E12345E'],

            // Non-battery electric vehicle
            ['粤E12345F'],
            ['粤E12345G'],
            ['粤E12345H'],
            ['粤E12345J'],
            ['粤E12345K'],
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

    /**
     * @return string[][]
     */
    public static function provide_invalid_large_clean_energy_vehicle_registration_numbers(): array
    {
        return [
            ['粤E1234DD'],
            ['粤E123D4D'],
            ['粤E12D34D'],
            ['粤E1D234D'],
            ['粤ED1234D'],
        ];
    }

    /**
     * @return string[][]
     */
    public static function provide_valid_special_registration_numbers(): array
    {
        return [
            ['京A0006警'],
            ['京A00006警'],
            ['粤E0000学'],
            ['粤E00000学'],
            ['粤E0000挂'],
            ['粤E00000挂'],
            ['粤Z0000港'],
            ['粤Z00000港'],
            ['粤Z0000澳'],
            ['粤Z00000澳'],
        ];
    }

    /**
     * @return string[][]
     */
    public static function provide_invalid_special_registration_numbers(): array
    {
        return [
            ['粤E0006假'],
            ['粤E0006港'],
            ['粤E0000澳'],
            ['粤Z0000警'],
            ['粤Z00000警'],
            ['粤Z0000学'],
            ['粤Z00000学'],
            ['粤Z0000挂'],
            ['粤Z00000挂'],
            ['粤Z0000试'],
            ['粤Z00000试'],
            ['粤Z0000超'],
            ['粤Z00000超'],
        ];
    }

    /**
     * @return string[][]
     */
    public static function provide_valid_embassy_registration_numbers(): array
    {
        return [
            ['224578使'],
        ];
    }

    /**
     * @return string[][]
     */
    public static function provide_invalid_embassy_registration_numbers(): array
    {
        return [
            ['22A578使'],
            ['224A78使'],
            ['2245A8使'],
            ['22457A使'],
            ['0224578使'],
            ['224578使使'],
        ];
    }

    /**
     * @return string[][]
     */
    public static function provide_valid_consulate_registration_numbers(): array
    {
        return [
            ['沪22478领'],
            ['沪2247A领'],
        ];
    }

    /**
     * @return string[][]
     */
    public static function provide_invalid_consulate_registration_numbers(): array
    {
        return [
            ['假22478领'],
            ['沪22-78领'],
            ['沪224A8领'],
            ['沪224O8领'],
            ['沪2247O领'],
            ['沪2247I领'],
            ['沪022478领'],
            ['沪22478领领'],
        ];
    }
}
