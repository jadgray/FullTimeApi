<?php

namespace Jadgray\FullTimeApi;

use Jadgray\FullTimeApi\DataFormatters\FixtureFormatter;
use Jadgray\FullTimeApi\DataFormatters\ResultFormatter;
use Jadgray\FullTimeApi\Division\Fixtures;
use Jadgray\FullTimeApi\Division\Results;
use Jadgray\FullTimeApi\Division\Teams;

class Division
{
    private readonly ResultFormatter $formatter;
    private readonly Teams $teams;
    private readonly Fixtures $fixtures;
    private readonly Results $results;

    public function __construct()
    {
        $fullTimeClient = new FullTimeClient();

        $this->formatter = new ResultFormatter();
        $this->teams = new Teams($fullTimeClient);
        $this->fixtures = new Fixtures($fullTimeClient);
        $this->results = new Results($fullTimeClient);
    }

    public function getTeams(int $seasonId, string $groupId): array
    {
        return $this->teams->getTeams($seasonId, $groupId);
    }

    public function getFixtures(int $seasonId, string $groupId): array
    {
        return $this->fixtures->getFixtures($seasonId, $groupId);
    }

    public function getResults(int $seasonId, string $groupId): array
    {
        return $this->results->getResults($seasonId, $groupId);
    }

    public function getFormattedFixtures(
        int    $seasonId,
        string $groupId,
        FixtureFormatter $formatter,
        bool   $includeTbcFixtures = true,
        bool   $includeCupFixtures = true,
        string $carbonDateFormat = null,
        string $carbonTimeFormat = null
    ): array {
        return $formatter->formatFixtures(
            $this->fixtures->getFixtures($seasonId, $groupId),
            $includeTbcFixtures,
            $includeCupFixtures,
            $carbonDateFormat,
            $carbonTimeFormat
        );
    }

    public function getFormattedResults(
        int    $seasonId,
        string $groupId,
        string $carbonDateFormat = null,
        string $carbonTimeFormat = null
    ): array {
        return $this->formatter->formatResults($this->results->getResults($seasonId, $groupId), $carbonDateFormat, $carbonTimeFormat);
    }
}
