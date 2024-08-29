<?php

namespace Jadgray\FullTimeApi\Division;

use Jadgray\FullTimeApi\FullTimeClient;
use Jadgray\FullTimeApi\Helpers\StringHelper;
use Jadgray\FullTimeApi\Traits\XpathTrait;

class Teams
{
    use XpathTrait;

    public function __construct(private readonly FullTimeClient $client)
    {
    }

    public function getTeams(int $seasonId, string $groupID): array
    {
        $data = $this->client->get(
            sprintf(
                'https://fulltime.thefa.com/fixtures.html?selectedSeason=%s&selectedFixtureGroupKey=%s&selectedDateCode=all&selectedRelatedFixtureOption=1&itemsPerPage=100',
                $seasonId,
                $groupID
            )
        );

        return $this->extractTeams($data);
    }

    public function extractTeams(string $data): array
    {
        $xpath = $this->createDomXPath($data);

        $teams = [];
        $teamNodes = $xpath->query('//*[@id="form1_selectedTeam"]/option');

        foreach ($teamNodes as $teamNode) {
            $teams[] = StringHelper::removeWhitespace($teamNode->textContent);
        }

        return $teams;
    }
}
