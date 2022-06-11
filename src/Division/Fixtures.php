<?php

namespace Jadgray\FullTimeApi\Division;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class Fixtures
{
    /***
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
    public function getFixtures(int $seasonId, string $groupId): Crawler
    {
        return $this->client->request('GET', sprintf(
            'https://fulltime.thefa.com/fixtures.html?selectedSeason=%s&selectedFixtureGroupKey=%s&selectedDateCode=all&selectedRelatedFixtureOption=1&previousSelectedFixtureGroupKey=%s&itemsPerPage=10000',
                $seasonId,
                $groupId,
                $groupId
            ));
    }

    /**
     * @param Crawler $fixtures
     * @return array
     */
    public function extractFixtures(Crawler $fixtures): array
    {
        return $fixtures->filter('table')->filter('tr')->each(function ($tr) {
            return $tr->filter('td')->each(function ($td) {
                $trim = trim($td->text());
                return str_replace(array("\n", "\r"), '', $trim);
            });
        });
    }
}