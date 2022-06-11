<?php

namespace Jadgray\FullTimeApi\Division;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class Results
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
     * @param string $groupId
     * @return Crawler
     */
    public function getResults(int $seasonId, string $groupId): Crawler
    {
        return $this->client->request('GET',
            sprintf(
                'https://fulltime.thefa.com/results.html?selectedSeason=%s&selectedFixtureGroupKey=%s&selectedDateCode=all&selectedRelatedFixtureOption=1&previousSelectedFixtureGroupKey=%s&itemsPerPage=10000',
                $seasonId,
                $groupId,
                $groupId
            ));
    }

    /**
     * @param Crawler $fixtures
     * @return array
     */
    public function extractResults(Crawler $fixtures): array
    {
        $results = $fixtures->filterXPath('//*[@id="results-list"]/div/div[3]/div/div[2]')->filter('div')->each(function ($div) {
            return $div->children()->each(function ($result) {
                return $result->html();
            });
        });

        $fixtureResults = [];

        foreach ($results[0] as $item) {
            $crawler = new Crawler($item);
            $fixtureDateTime = $crawler->filter('.datetime-col')->first()->text();
            $homeTeam = $crawler->filter('.home-team-col')->first()->text();
            $awayTeam = $crawler->filter('.road-team-col')->first()->text();
            $score = $crawler->filter('.score-col')->first()->text();
            $division = $crawler->filter('.fg-col')->first()->text();

            $fixtureResults[] = [
                $fixtureDateTime,
                $homeTeam,
                $score,
                $awayTeam,
                $division
            ];
        }
        return $fixtureResults;
    }
}