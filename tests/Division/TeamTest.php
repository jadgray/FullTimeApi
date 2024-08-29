<?php

namespace Division;

use Jadgray\FullTimeApi\Division\Teams;
use Jadgray\FullTimeApi\FullTimeClient;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class TeamTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_getting_teams_from_full_time(): void
    {
        $seasonId = 2023;
        $groupId = '24';
        $expectedUrl = 'https://fulltime.thefa.com/fixtures.html?selectedSeason=2023&selectedFixtureGroupKey=24&selectedDateCode=all&selectedRelatedFixtureOption=1&itemsPerPage=100';
        $expectedResponse = file_get_contents(__DIR__ . '/../Examples/example_fixtures.html');

        $clientMock = $this->createMock(FullTimeClient::class);
        $clientMock->expects($this->once())
            ->method('get')
            ->with($expectedUrl)
            ->willReturn($expectedResponse);

        $teams = new Teams($clientMock);

        $teamData = $teams->getTeams($seasonId, $groupId);

        $this->assertCount(9, $teamData);
        $this->assertEquals($this->expectedTeamsArray(), $teamData);
    }

    private function expectedTeamsArray(): array
    {
        return
            [
                "All",
                "Blackburn Eagles JFC - Blue U7S",
                "Junior Gardeners - U7S",
                "Junior Hoops JFC - Bears U7S",
                "Junior Hoops JFC - Cobras U7S",
                "Junior Hoops JFC - Dragons U7S",
                "Rosegrove FC - Clarets U7S",
                "Rosegrove FC - Rangers U7S",
                "Rossendale United - Yellow U7S"
            ];
    }
}
