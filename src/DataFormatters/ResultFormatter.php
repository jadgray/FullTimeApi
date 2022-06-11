<?php

namespace Jadgray\FullTimeApi\DataFormatters;

use Carbon\Carbon;

class ResultFormatter
{
    public const DEFAULT_DATE_FORMAT = 'd/m/Y';
    public const DEFAULT_TIME_FORMAT = 'H:i';
    public const FULL_TIME_DATE_FORMAT = 'd/m/y H:i';

    private $results;
    private $timeFormat;
    private $dateFormat;

    /**
     * @param string|null $carbonDateFormat
     * @param string|null $carbonTimeFormat
     */
    public function __construct(string $carbonDateFormat = null, string $carbonTimeFormat = null)
    {
        $this->dateFormat = $carbonDateFormat ?: self::DEFAULT_DATE_FORMAT;
        $this->timeFormat = $carbonTimeFormat ?: self::DEFAULT_TIME_FORMAT;
        $this->results = [];
    }

    /**
     * @param array $results
     * @return array
     */
    public function formatResults(array $results): array
    {
        foreach ($results as $result) {
            $fixtureDate = Carbon::createFromFormat(self::FULL_TIME_DATE_FORMAT, $result[0])->format($this->dateFormat);
            $fixtureTime = Carbon::createFromFormat(self::FULL_TIME_DATE_FORMAT, $result[0])->format($this->timeFormat);

            preg_match('/(\d+)/', $result[2], $homeScore);
            preg_match('/(\d+)(?!.*\d)/', $result[2], $awayScore);

            $this->results[] = [
                'Date' => $fixtureDate,
                'Time' => $fixtureTime,
                'Home' => $result[1],
                'HomeScore' => $homeScore[0],
                'Away' => $result[3],
                'AwayScore' => $awayScore[0],
                'FullScore' => $result[2]
            ];

        }
        return $this->results;
    }
}