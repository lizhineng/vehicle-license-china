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
        static::validateAuthority($registrationNumber);
        static::validateSequence($registrationNumber);

        return new self($registrationNumber);
    }

    private static function validateAuthority(string $registrationNumber): void
    {
        $region = mb_substr($registrationNumber, 0, 1);
        $authorities = self::AUTHORITIES[$region] ?? [];

        if ($authorities === []) {
            static::notValid($registrationNumber);
        }

        $code = mb_substr($registrationNumber, 1, 1);

        if ($code === 'O') {
            return;
        }

        if (! in_array($code, $authorities)) {
            static::notValid($registrationNumber);
        }
    }

    private static function validateSequence(string $registrationNumber): void
    {
        $sequence = mb_strtoupper(mb_substr($registrationNumber, 2));

        $valid = match (mb_strlen($sequence)) {
            4, 5 => static::checkSequenceForGeneral($sequence),
            6 => static::checkSequenceForCleanEnergy($sequence),
            default => static::notValid($registrationNumber),
        };

        if (! $valid) {
            static::notValid($registrationNumber);
        }
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

    public function isBatteryElectric(): bool
    {
        if (! $this->isCleanEnergy()) {
            return false;
        }

        $code = mb_substr($this->sequence, 0, 1);

        return in_array($code, self::BATTERY_ELECTRIC_LETTERS);
    }
}
