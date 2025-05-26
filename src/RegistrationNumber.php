<?php

declare(strict_types=1);

namespace Zhineng\VehicleLicenseChina;

final readonly class RegistrationNumber
{
    /**
     * Pairs of region name and authority codes.
     *
     * @var string[][]
     */
    private const array AUTHORITIES = [
        '京' => [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
            'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        ],
        '津' => [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
            'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        ],
        '冀' => [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'R', 'T',
        ],
        '晋' => [
            'A', 'B', 'C', 'D', 'E', 'F', 'H', 'J', 'K', 'L', 'M',
        ],
        '蒙' => [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L', 'M',
        ],
        '辽' => [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N',
            'P',
        ],
        '吉' => [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K',
        ],
        '黑' => [
            'A', 'L', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'M', 'N',
            'P', 'R',
        ],
        '沪' => [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
            'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        ],
        '苏' => [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N',
        ],
        '浙' => [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L',
        ],
        '皖' => [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N',
            'P', 'R', 'S',
        ],
        '闽' => [
            'A', 'K', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J',
        ],
        '赣' => [
            'A', 'M', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L',
        ],
        '鲁' => [
            'A', 'B', 'U', 'C', 'D', 'E', 'F', 'Y', 'G', 'V', 'H', 'J', 'K',
            'L', 'M', 'N', 'P', 'Q', 'R', 'S',
            'W', // Reserved for internal
        ],
        '豫' => [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N',
            'P', 'Q', 'R', 'S', 'U',
        ],
        '鄂' => [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N',
            'P', 'Q', 'R', 'S',
        ],
        '湘' => [
            'A', 'S', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L', 'M',
            'N', 'U',
        ],
        '粤' => [
            'A', 'B', 'C', 'D', 'E', 'X', 'Y', 'F', 'G', 'H', 'J', 'K', 'L',
            'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W',
            'Z', // Reserved for internal
        ],
        '桂' => [
            'A', 'B', 'C', 'H', 'D', 'E', 'F', 'G', 'J', 'K', 'L', 'M', 'N',
            'P', 'R',
        ],
        '琼' => [
            'A', 'B', 'C', 'D', 'E', 'F',
        ],
        '渝' => [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
            'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        ],
        '川' => [
            'A', 'G', 'B', 'C', 'D', 'E', 'F', 'H', 'J', 'K', 'L', 'M', 'Q',
            'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        ],
        '贵' => [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J',
        ],
        '云' => [
            'A', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N', 'P',
            'Q', 'R', 'S',
        ],
        '藏' => [
            'A', 'B', 'C', 'D', 'E', 'F', 'G',
        ],
        '陕' => [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'V',
        ],
        '甘' => [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N',
            'P',
        ],
        '青' => [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H',
        ],
        '宁' => [
            'A', 'B', 'C', 'E',
        ],
        '新' => [
            'A', 'B', 'C', 'E', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N',
            'P', 'Q', 'R',
        ],
    ];

    /**
     * @var string[]
     */
    private const array CLEAN_ENERGY_FIRST_LETTERS = [
        'D', 'A', 'B', 'C', 'E',
        'F', 'G', 'H', 'J', 'K',
    ];

    /**
     * @var string[]
     */
    private const array BATTERY_ELECTRIC_LETTERS = [
        'D', 'A', 'B', 'C', 'E',
    ];

    /**
     * @var string[]
     */
    private const array AVAILLABLE_SUFFIXS = [
        self::EMBASSY_SUFFIX,
        self::CONSULATE_SUFFIX,
        self::POLICE_SUFFIX,
        self::COACH_SUFFIX,
        self::TRAILER_SUFFIX,
        self::HONG_KONG_SUFFIX,
        self::MACAU_SUFFIX,
        self::TEST_SUFFIX,
        self::SPECIAL_SUFFIX,
    ];

    /**
     * @var string[]
     */
    private const array GUANGDONG_Z_SPECIAL_SUFFIXS = [
        self::HONG_KONG_SUFFIX,
        self::MACAU_SUFFIX,
    ];

    private const string GUANGDONG_PROVINCE = '粤';

    private const string GUANGDONG_SPECIAL_AUTHORITY = 'Z';

    private const string EMBASSY_SUFFIX = '使';

    private const string CONSULATE_SUFFIX = '领';

    private const string POLICE_SUFFIX = '警';

    private const string COACH_SUFFIX = '学';

    private const string TRAILER_SUFFIX = '挂';

    private const string HONG_KONG_SUFFIX = '港';

    private const string MACAU_SUFFIX = '澳';

    private const string TEST_SUFFIX = '试';

    private const string SPECIAL_SUFFIX = '超';

    public string $region;

    public string $agencyNumber;

    public string $authority;

    public string $sequence;

    public string $suffix;

    private function __construct(
        public string $registrationNumber
    ) {
        $this->parse($registrationNumber);
    }

    public static function make(string $registrationNumber): static
    {
        static::validate($registrationNumber);

        return new self($registrationNumber);
    }

    private static function validate(string $registrationNumber): void
    {
        $registrationNumber = mb_strtoupper($registrationNumber);
        $last = mb_substr($registrationNumber, -1);

        match ($last) {
            self::EMBASSY_SUFFIX => static::validateEmbassyRegistrationNumber($registrationNumber),
            self::CONSULATE_SUFFIX => static::validateConsulateRegistrationNumber($registrationNumber),
            default => static::validateRegistrationNumber($registrationNumber),
        };
    }

    private static function validateEmbassyRegistrationNumber(string $registrationNumber): void
    {
        if (! static::checkEmbassyRegistrationNumberLength($registrationNumber)) {
            static::notValid($registrationNumber);
        }

        [$agencyNumber, $sequence, $suffix] = static::extractEmbassyComponents($registrationNumber);

        if (! static::checkAgencyNumber($agencyNumber)) {
            static::notValid($registrationNumber);
        }

        if (! static::checkEmbassySequence($sequence)) {
            static::notValid($registrationNumber);
        }

        if ($suffix !== self::EMBASSY_SUFFIX) {
            static::notValid($registrationNumber);
        }
    }

    private static function validateConsulateRegistrationNumber(string $registrationNumber): void
    {
        if (! static::checkConsulateRegistrationNumberLength($registrationNumber)) {
            static::notValid($registrationNumber);
        }

        [$region, $agencyNumber, $sequence, $suffix] = static::extractConsulateComponents($registrationNumber);

        if (! isset(self::AUTHORITIES[$region])) {
            static::notValid($registrationNumber);
        }

        if (! static::checkAgencyNumber($agencyNumber)) {
            static::notValid($registrationNumber);
        }

        if (! static::checkConsulateSequence($sequence)) {
            static::notValid($registrationNumber);
        }

        if ($suffix !== self::CONSULATE_SUFFIX) {
            static::notValid($registrationNumber);
        }
    }

    private static function checkEmbassyRegistrationNumberLength(string $registrationNumber): bool
    {
        $agencyNumber = 3;
        $sequence = 3;
        $suffix = 1;

        return mb_strlen($registrationNumber) === $agencyNumber + $sequence + $suffix;
    }

    private static function checkConsulateRegistrationNumberLength(string $registrationNumber): bool
    {
        $region = 1;
        $agencyNumber = 3;
        $sequence = 2;
        $suffix = 1;

        return mb_strlen($registrationNumber) === $region + $agencyNumber + $sequence + $suffix;
    }

    private static function validateRegistrationNumber(string $registrationNumber): void
    {
        [$region, $authority, $sequence, $suffix] = static::extractComponents($registrationNumber);

        if (! static::checkAuthority($region, $authority)) {
            static::notValid($registrationNumber);
        }

        if (! static::checkSequence($sequence)) {
            static::notValid($registrationNumber);
        }

        if (! static::checkSuffix($region, $authority, $sequence, $suffix)) {
            static::notValid($registrationNumber);
        }
    }

    /**
     * @return string[]
     */
    private static function extractEmbassyComponents(string $registrationNumber): array
    {
        $agency = mb_substr($registrationNumber, 0, 3);
        $sequence = mb_substr($registrationNumber, 3, 3);
        $suffix = mb_substr($registrationNumber, 6, 1);

        return [$agency, $sequence, $suffix];
    }

    /**
     * @return string[]
     */
    private static function extractConsulateComponents(string $registrationNumber): array
    {
        $region = mb_substr($registrationNumber, 0, 1);
        $agencyNumber = mb_substr($registrationNumber, 1, 3);
        $sequence = mb_substr($registrationNumber, 4, 2);
        $suffix = mb_substr($registrationNumber, 6, 1);

        return [$region, $agencyNumber, $sequence, $suffix];
    }

    /**
     * @return string[]
     */
    private static function extractComponents(string $registrationNumber): array
    {
        $region = mb_substr($registrationNumber, 0, 1);
        $authority = mb_substr($registrationNumber, 1, 1);

        $last = mb_substr($registrationNumber, -1);

        $suffix = in_array($last, self::AVAILLABLE_SUFFIXS, strict: true)
            ? $last
            : '';

        $sequence = $suffix === ''
            ? mb_substr($registrationNumber, 2)
            : mb_substr($registrationNumber, 2, -1);

        return [
            $region, $authority, $sequence, $suffix,
        ];
    }

    private static function checkAgencyNumber(string $agencyNumber): bool
    {
        return preg_match('/^\d{3}$/', $agencyNumber) === 1;
    }

    private static function checkAuthority(string $region, string $authority): bool
    {
        $authorities = self::AUTHORITIES[$region] ?? [];

        if ($authorities === []) {
            return false;
        }

        if ($authority === 'O') {
            return true;
        }

        return in_array($authority, $authorities, strict: true);
    }

    private static function checkSequence(string $sequence): bool
    {
        return match (mb_strlen($sequence)) {
            4, 5 => static::checkSequenceForGeneral($sequence),
            6 => static::checkSequenceForCleanEnergy($sequence),
            default => false,
        };
    }

    private static function checkSuffix(
        string $region, string $authority, string $sequence, string $suffix
    ): bool {
        // Ensure the HK or Macau suffix is only available to Guangdong-Z
        if (in_array($suffix, self::GUANGDONG_Z_SPECIAL_SUFFIXS, strict: true)) {
            if (! ($region === self::GUANGDONG_PROVINCE
                && $authority === self::GUANGDONG_SPECIAL_AUTHORITY)) {
                return false;
            }
        // Ensure the Guangdong-Z license plate ends with either an "HK" or a "Macau" suffix
        } else if ($region === self::GUANGDONG_PROVINCE
            && $authority === self::GUANGDONG_SPECIAL_AUTHORITY) {
            if (! in_array($suffix, self::GUANGDONG_Z_SPECIAL_SUFFIXS, strict: true)) {
                return false;
            }
        }

        // If the license plate has a suffix, the sequence must be 4 or 5 characters long
        if ($suffix !== '' && in_array($suffix, self::AVAILLABLE_SUFFIXS, strict: true)) {
            $len = mb_strlen($sequence);

            return $len >= 4 && $len <= 5;
        }

        return true;
    }

    private static function checkEmbassySequence(string $sequence): bool
    {
        return preg_match('/^\d{3}$/', $sequence) === 1;
    }

    private static function checkConsulateSequence(string $sequence): bool
    {
        $len = mb_strlen($sequence);

        if ($len !== 2) {
            return false;
        }

        $first = mb_ord($sequence[0]);
        $last = mb_ord($sequence[1]);

        if ($first >= ord('0') && $first <= ord('9')
            && $last >= ord('0') && $last <= ord('9')) {
            return true;
        }

        if ($first >= ord('0') && $first <= ord('9')
            && $last >= ord('A') && $last <= ord('Z')) {
            return $last !== ord('O') && $last !== ord('I');
        }

        return false;
    }

    private static function checkSequenceForGeneral(string $sequence): bool
    {
        $letters = 0;

        for ($i = 0; $i < strlen($sequence); $i++) {
            $codepoint = mb_ord($sequence[$i]);

            if ($codepoint === false) {
                return false;
            }

            if ($codepoint >= ord('A') && $codepoint <= ord('Z')) {
                if ($codepoint === ord('O') || $codepoint === ord('I')) {
                    return false;
                }

                $letters++;
            } else if ($codepoint < ord('0') || $codepoint > ord('9')) {
                return false;
            }
        }

        return $letters <= 2;
    }

    private static function checkSequenceForCleanEnergy(string $sequence): bool
    {
        $sequence = mb_strtoupper($sequence);

        $last = mb_substr($sequence, -1);
        $codepoint = mb_ord($last);

        if (is_int($codepoint) && $codepoint >= ord('A') && $codepoint <= ord('Z')) {
            return static::checkSequenceForLargeCleanEnergy($sequence);
        }

        return static::checkSequenceForSmallCleanEnergy($sequence);
    }

    private static function checkSequenceForLargeCleanEnergy(string $sequence): bool
    {
        $last = mb_substr($sequence, -1);

        if (! in_array($last, self::CLEAN_ENERGY_FIRST_LETTERS)) {
            return false;
        }

        for ($i = 0; $i < mb_strlen($sequence) - 1; $i++) {
            $codepoint = mb_ord($sequence[$i]);

            if ($codepoint === false) {
                return false;
            }

            if ($codepoint < ord('0') || $codepoint > ord('9')) {
                return false;
            }
        }

        return true;
    }

    private static function checkSequenceForSmallCleanEnergy(string $sequence): bool
    {
        $first = mb_substr($sequence, 0, 1);

        if (! in_array($first, self::CLEAN_ENERGY_FIRST_LETTERS)) {
            return false;
        }

        $second = mb_substr($sequence, 1, 1);
        $second = mb_ord($second);

        if ($second === false) {
            return false;
        }

        if (($second < ord('A') || $second > ord('Z'))
            && ($second < ord('0') || $second > ord('9'))) {
            return false;
        }

        if ($second === ord('O') || $second === ord('I')) {
            return false;
        }

        for ($i = 2; $i < strlen($sequence); $i++) {
            $codepoint = mb_ord($sequence[$i]);

            if ($codepoint < ord('0') || $codepoint > ord('9')) {
                return false;
            }
        }

        return true;
    }

    private static function notValid(string $registrationNumber): never
    {
        throw new RegistrationNumberException(sprintf(
            'The registration number "%s" is invalid.', $registrationNumber
        ));
    }

    private function parse(string $registrationNumber): void
    {
        $registrationNumber = mb_strtoupper($registrationNumber);

        $last = mb_substr($registrationNumber, -1);

        match ($last) {
            self::EMBASSY_SUFFIX => $this->parseEmbassyRegistrationNumber($registrationNumber),
            self::CONSULATE_SUFFIX => $this->parseConsulateRegistrationNumber($registrationNumber),
            default => $this->parseRegistrationNumber($registrationNumber),
        };
    }

    private function parseEmbassyRegistrationNumber(string $registrationNumber): void
    {
        [$agency, $sequence, $suffix] = static::extractEmbassyComponents($registrationNumber);

        $this->agencyNumber = $agency;
        $this->sequence = $sequence;
        $this->suffix = $suffix;

        $this->region = '';
        $this->authority = '';
    }

    private function parseConsulateRegistrationNumber(string $registrationNumber): void
    {
        [$region, $agency, $sequence, $suffix] = static::extractConsulateComponents($registrationNumber);

        $this->region = $region;
        $this->agencyNumber = $agency;
        $this->sequence = $sequence;
        $this->suffix = $suffix;

        $this->authority = '';
    }

    private function parseRegistrationNumber(string $registrationNumber): void
    {
        [$region, $authority, $sequence, $suffix] = static::extractComponents($registrationNumber);

        $this->region = $region;
        $this->authority = $authority;
        $this->sequence = $sequence;
        $this->suffix = $suffix;

        $this->agencyNumber = '';
    }

    public function isEmbassy(): bool
    {
        return $this->suffix === self::EMBASSY_SUFFIX;
    }

    public function isConsulate(): bool
    {
        return $this->suffix === self::CONSULATE_SUFFIX;
    }

    public function isPolice(): bool
    {
        return $this->suffix === self::POLICE_SUFFIX;
    }

    public function isCoach(): bool
    {
        return $this->suffix === self::COACH_SUFFIX;
    }

    public function isTrailer(): bool
    {
        return $this->suffix === self::TRAILER_SUFFIX;
    }

    public function isFromHongKong(): bool
    {
        return $this->suffix === self::HONG_KONG_SUFFIX;
    }

    public function isFromMacau(): bool
    {
        return $this->suffix === self::MACAU_SUFFIX;
    }

    public function isTest(): bool
    {
        return $this->suffix === self::TEST_SUFFIX;
    }

    public function isSpecial(): bool
    {
        return $this->suffix === self::SPECIAL_SUFFIX;
    }

    public function isCleanEnergy(): bool
    {
        return strlen($this->sequence) === 6;
    }

    public function isSmallCleanEnergy(): bool
    {
        if (! $this->isCleanEnergy()) {
            return false;
        }

        $first = mb_substr($this->sequence, 0, 1);

        return in_array($first, self::CLEAN_ENERGY_FIRST_LETTERS, strict: true);
    }

    public function isLargeCleanEnergy(): bool
    {
        if (! $this->isCleanEnergy()) {
            return false;
        }

        $last = mb_substr($this->sequence, -1);

        return in_array($last, self::CLEAN_ENERGY_FIRST_LETTERS, strict: true);
    }

    public function isBatteryElectric(): bool
    {
        $letter = match (true) {
            $this->isSmallCleanEnergy() => mb_substr($this->sequence, 0, 1),
            $this->isLargeCleanEnergy() => mb_substr($this->sequence, -1),
            default => false,
        };

        if ($letter === false) {
            return false;
        }

        return in_array($letter, self::BATTERY_ELECTRIC_LETTERS, strict: true);
    }
}
