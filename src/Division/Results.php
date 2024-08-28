<?php

namespace Jadgray\FullTimeApi\Division;

use DOMNode;
use DOMXPath;
use Jadgray\FullTimeApi\FullTimeClient;
use Jadgray\FullTimeApi\Helpers\StringHelper;
use Jadgray\FullTimeApi\Traits\XpathTrait;

class Results
{
    use XpathTrait;

    public function __construct(private readonly FullTimeClient $client)
    {
    }

    public function getResults(int $seasonId, string $groupId): array
    {
        $data = $this->client->get(
            sprintf(
                'https://fulltime.thefa.com/results.html?selectedSeason=%s&selectedFixtureGroupKey=%s&selectedDateCode=all&selectedRelatedFixtureOption=1&previousSelectedFixtureGroupKey=%s&itemsPerPage=10000',
                $seasonId,
                $groupId,
                $groupId
            ));

        return $this->extractResults($data);
    }

    public function extractResults(string $data): array
    {
        $xpath = $this->createDomXPath($data);
        $resultNodes = $xpath->query('//*[@id="results-list"]/div/div[3]/div/div[2]/div');

        $fixtureResults = [];

        foreach ($resultNodes as $node) {
            $fixtureResults[] = $this->extractFixtureResult($xpath, $node);
        }

        return $fixtureResults;
    }

    private function extractFixtureResult(DOMXPath $xpath, DOMNode $node): array
    {
        $fixtureDateTime = StringHelper::removeWhitespace($this->extractNodeContent($xpath, $node, './/div[contains(@class, "datetime-col")]'));
        $homeTeam = $this->extractNodeContent($xpath, $node, './/div[contains(@class, "home-team-col")]');
        $awayTeam = $this->extractNodeContent($xpath, $node, './/div[contains(@class, "road-team-col")]');
        $score = $this->extractNodeContent($xpath, $node, './/div[contains(@class, "score-col")]');
        $division = $this->extractNodeContent($xpath, $node, './/div[contains(@class, "fg-col")]');

        return [
            $fixtureDateTime,
            $homeTeam,
            $score,
            $awayTeam,
            $division,
        ];
    }

    private function extractNodeContent(DOMXPath $xpath, DOMNode $contextNode, string $query): string
    {
        $node = $xpath->query($query, $contextNode)->item(0);

        return $node ? trim($node->textContent) : '';
    }

}