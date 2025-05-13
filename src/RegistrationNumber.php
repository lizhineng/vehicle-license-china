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
    private const array SPECIAL_SUFFIXS = [
        '领', '使', '警', '学', '挂', '港', '澳', '试', '超',
    ];

    /**
     * @var string[]
     */
    private const array GUANGDONG_Z_SPECIAL_SUFFIXS = [
        '港', '澳',
    ];

    private const string GUANGDONG_PROVINCE = '粤';

    private const string GUANGDONG_SPECIAL_AUTHORITY = 'Z';

    public string $region;

    public string $authority;

    public string $sequence;

    private function __construct(
        public string $registrationNumber
    ) {
        $this->parse($registrationNumber);
    }

    public static function make(string $registrationNumber): static
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

        return new self($registrationNumber);
    }

    /**
     * @return string[]
     */
    private static function extractComponents(string $registrationNumber): array
    {
        $normalized = mb_strtoupper($registrationNumber);

        $region = mb_substr($normalized, 0, 1);
        $authority = mb_substr($normalized, 1, 1);

        $last = mb_substr($normalized, -1);

        $suffix = in_array($last, self::SPECIAL_SUFFIXS, strict: true)
            ? $last
            : '';

        $sequence = $suffix === ''
            ? mb_substr($normalized, 2)
            : mb_substr($normalized, 2, -1);

        return [
            $region, $authority, $sequence, $suffix,
        ];
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
        if (in_array($suffix, self::GUANGDONG_Z_SPECIAL_SUFFIXS, strict: true)) {
            return $region === self::GUANGDONG_PROVINCE
                && $authority === self::GUANGDONG_SPECIAL_AUTHORITY;
        }

        if ($suffix !== '' && ! in_array($suffix, self::SPECIAL_SUFFIXS, strict: true)) {
            $len = mb_strlen($sequence);

            return $len >= 4 && $len <= 5;
        }

        return true;
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
        $this->region = mb_substr($registrationNumber, 0, 1);
        $this->authority = mb_substr($registrationNumber, 1, 1);
        $this->sequence = mb_substr($registrationNumber, 2);
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
