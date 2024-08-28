<?php

namespace Jadgray\FullTimeApi\Division;

use DOMNode;
use DOMXPath;
use Jadgray\FullTimeApi\FullTimeClient;
use Jadgray\FullTimeApi\Helpers\StringHelper;
use Jadgray\FullTimeApi\Traits\XpathTrait;

class Fixtures
{
    use XpathTrait;

    public function __construct(private readonly FullTimeClient $client)
    {
    }

    public function getFixtures(int $seasonId, string $groupId): array
    {
        $url = sprintf(
            'https://fulltime.thefa.com/fixtures.html?selectedSeason=%s&selectedFixtureGroupKey=%s&selectedDateCode=all&selectedRelatedFixtureOption=1&previousSelectedFixtureGroupKey=%s&itemsPerPage=10000',
            $seasonId,
            $groupId,
            $groupId
        );

        $data = $this->client->get($url);

        return $this->extractFixtures($data);
    }

    private function extractFixtures(string $data): array
    {
        $xpath = $this->createDomXPath($data);
        $rows = $xpath->query('//table//tr');
        $fixtures = [];

        foreach ($rows as $row) {
            $fixture = $this->extractFixtureFromRow($xpath, $row);

            if (!empty($fixture)) {
                $fixtures[] = $fixture;
            }
        }

        return $fixtures;
    }

    private function extractFixtureFromRow(DOMXPath $xpath, DOMNode $row): array
    {
        $cells = $xpath->query('td', $row);

        return array_map(static function ($cell) {
            return StringHelper::removeWhitespace($cell->textContent);
        }, iterator_to_array($cells));
    }
}
