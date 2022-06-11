<?php

namespace Jadgray\FullTimeApi\Division;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class Teams
{
    /**
     * @var Client
     */
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param int $seasonId
     * @param string $groupID
     * @return Crawler
     */
    public function getTeams(int $seasonId, string $groupID): Crawler
    {
        return
            $this->client->request('GET',
                sprintf('https://fulltime.thefa.com/fixtures.html?selectedSeason=%s&selectedFixtureGroupKey=%s&selectedDateCode=all&selectedRelatedFixtureOption=1&itemsPerPage=100',
                    $seasonId,
                    $groupID
                ));
    }

    /**
     * @param Crawler $teams
     * @return array
     */
    public function extractTeams(Crawler $teams): array
    {
        return $teams->filterXPath('//*[@id="form1_selectedTeam"]')->children()->each(function ($team) {
            return $team->filter('option')->each(function ($option) {
                return trim($option->text());
            });
        });
    }
}