<?php

namespace Jadgray\FullTimeApi;

use Jadgray\FullTimeApi\DataFormatters\FixtureFormatter;
use Jadgray\FullTimeApi\DataFormatters\ResultFormatter;
use Jadgray\FullTimeApi\Division\Fixtures;
use Jadgray\FullTimeApi\Division\Results;
use Jadgray\FullTimeApi\Division\Teams;

class Division
{
    /**
     * @var Teams
     */
    private $teams;

    /**
     * @var Fixtures
     */
    private $fixtures;

    /**
     * @var Results
     */
    private $results;

    public function __construct()
    {
        $this->teams = new Teams();
        $this->fixtures = new Fixtures();
        $this->results = new Results();
    }

    /**
     * @param int $seasonId
     * @param string $groupId
     * @return array
     */
    public function getTeams(int $seasonId, string $groupId): array
    {
        $teams = $this->teams->getTeams($seasonId, $groupId);

        return $this->teams->extractTeams($teams);
    }

    /**
     * @param int $seasonId
     * @param string $groupId
     * @return array
     */
    public function getFixtures(int $seasonId, string $groupId): array
    {
        $fixtures = $this->fixtures->getFixtures($seasonId, $groupId);

        return $this->fixtures->extractFixtures($fixtures);
    }

    /**
     * @param int $seasonId
     * @param string $groupId
     * @param string|null $carbonDateFormat
     * @param string|null $carbonTimeFormat
     * @param bool $includeTbcFixtures
     * @param bool $includeCupFixtures
     * @return array
     */
    public function getFormattedFixtures(
        int    $seasonId,
        string $groupId,
        bool   $includeTbcFixtures = true,
        bool   $includeCupFixtures = true,
        string $carbonDateFormat = null,
        string $carbonTimeFormat = null
    ): array
    {
        $fixtures = $this->fixtures->getFixtures($seasonId, $groupId);

        return (new FixtureFormatter($carbonDateFormat, $carbonTimeFormat))->formatFixtures(
                $this->fixtures->extractFixtures($fixtures),
                $includeTbcFixtures,
                $includeCupFixtures
        );
    }

    /**
     * @param int $seasonId
     * @param string $groupId
     * @return array
     */
    public function getResults(int $seasonId, string $groupId): array
    {
        $results = $this->results->getResults($seasonId, $groupId);

        return $this->results->extractResults($results);
    }

    /**
     * @param int $seasonId
     * @param string $groupId
     * @param string|null $carbonDateFormat
     * @param string|null $carbonTimeFormat
     * @return array
     */
    public function getFormattedResults(
        int    $seasonId,
        string $groupId,
        string $carbonDateFormat = null,
        string $carbonTimeFormat = null): array
    {
        $results = $this->results->getResults($seasonId, $groupId);

        return (new ResultFormatter($carbonDateFormat, $carbonTimeFormat))->formatResults($this->results->extractResults($results));
    }
}