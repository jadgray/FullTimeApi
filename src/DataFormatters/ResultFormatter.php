<?php

namespace Jadgray\FullTimeApi\DataFormatters;

use Carbon\Carbon;
use Jadgray\FullTimeApi\Enum\DateTypes;

class ResultFormatter
{
    public function formatResults(array $results, string $carbonDateFormat = null, string $carbonTimeFormat = null): array
    {
        $formattedResults = [];

        foreach ($results as $result) {
            $fixtureDate = Carbon::createFromFormat(DateTypes::FULL_TIME_DATE->value, $result[0])->format($carbonDateFormat ?? DateTypes::DATE->value);
            $fixtureTime = Carbon::createFromFormat(DateTypes::FULL_TIME_DATE->value, $result[0])->format($carbonTimeFormat ?? DateTypes::TIME->value);

            preg_match('/(\d+)/', $result[2], $homeScore);
            preg_match('/(\d+)(?!.*\d)/', $result[2], $awayScore);

            $formattedResults[] = [
                'Date' => $fixtureDate,
                'Time' => $fixtureTime,
                'Home' => $result[1],
                'HomeScore' => $homeScore[0],
                'Away' => $result[3],
                'AwayScore' => $awayScore[0],
                'FullScore' => $result[2]
            ];

        }

        return $formattedResults;
    }
}
