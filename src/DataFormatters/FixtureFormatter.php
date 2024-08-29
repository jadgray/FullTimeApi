<?php

namespace Jadgray\FullTimeApi\DataFormatters;

use Carbon\Carbon;
use Jadgray\FullTimeApi\Enum\DateTypes;

class FixtureFormatter
{
    public function formatFixtures(
        array $fixtures,
        bool $includeTbcFixtures = true,
        bool $includeCupFixtures = true,
        $carbonDateFormat = null,
        $carbonTimeFormat = null
    ): array {
        $fixtures = array_filter($fixtures);

        $formattedFixtures = [];

        foreach ($fixtures as $fixture) {

            if ( ! $includeCupFixtures && $fixture[0] === 'Cup') {
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

            $fixtureDate = Carbon::createFromFormat(DateTypes::FULL_TIME_DATE->value, $fixture[1])->format($carbonDateFormat ?? DateTypes::DATE->value);
            $fixtureTime = Carbon::createFromFormat(DateTypes::FULL_TIME_DATE->value, $fixture[1])->format($carbonTimeFormat ?? DateTypes::TIME->value);

            $formattedFixtures[] = [
                'Date' => $fixtureDate,
                'Home' => $fixture[2],
                'Away' => $fixture[6],
                'Time' => $fixtureTime,
                'FixtureType' => $fixture[0]
            ];
        }

        return $formattedFixtures;
    }
}
