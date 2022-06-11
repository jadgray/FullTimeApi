<?php

namespace Jadgray\FullTimeApi\DataFormatters;

use Carbon\Carbon;

class FixtureFormatter
{
    public const DEFAULT_DATE_FORMAT = 'd/m/Y';
    public const DEFAULT_TIME_FORMAT = 'H:i';
    public const FULL_TIME_DATE_FORMAT = 'd/m/y H:i';

    /**
     * @var array
     */
    private $fixtures;

    /**
     * @var string
     */
    private $dateFormat;

    /**
     * @var string
     */
    private $timeFormat;

    /**
     * @param string|null $carbonDateFormat
     * @param string|null $carbonTimeFormat
     */
    public function __construct(string $carbonDateFormat = null, string $carbonTimeFormat = null)
    {
        $this->dateFormat = $carbonDateFormat ?: self::DEFAULT_DATE_FORMAT;
        $this->timeFormat = $carbonTimeFormat ?: self::DEFAULT_TIME_FORMAT;
        $this->fixtures = [];
    }

    /**
     * @param array $fixtures
     * @param bool $includeTbcFixtures
     * @param bool $includeCupFixtures
     * @return array
     */
    public function formatFixtures(array $fixtures, bool $includeTbcFixtures = true, bool $includeCupFixtures = true): array
    {
        $fixtures = array_filter($fixtures);

        foreach ($fixtures as $fixture) {

            if (!$includeCupFixtures && $fixture[0] === 'Cup') {
                continue;
            }

            if ($includeTbcFixtures && $fixture[1] === 'TBC') {
                $this->fixtures[] = [
                    'Date' => 'TBC',
                    'Home' => $fixture[2],
                    'Away' => $fixture[6],
                    'Time' => 'TBC',
                    'FixtureType' => $fixture[0]
                ];
                continue;
            }

            $fixtureDate = Carbon::createFromFormat(self::FULL_TIME_DATE_FORMAT, $fixture[1])->format($this->dateFormat);
            $fixtureTime = Carbon::createFromFormat(self::FULL_TIME_DATE_FORMAT, $fixture[1])->format($this->timeFormat);

            $this->fixtures[] = [
                'Date' => $fixtureDate,
                'Home' => $fixture[2],
                'Away' => $fixture[6],
                'Time' => $fixtureTime,
                'FixtureType' => $fixture[0]
            ];
        }
        return $this->fixtures;
    }
}