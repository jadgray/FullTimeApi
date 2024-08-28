<?php

namespace Division;

use Jadgray\FullTimeApi\Division\Results;
use Jadgray\FullTimeApi\FullTimeClient;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class ResultsTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_getting_results_from_full_time(): void
    {
        $seasonId = 2023;
        $groupId = '1_abcbcbcbc';
        $expectedUrl = 'https://fulltime.thefa.com/results.html?selectedSeason=2023&selectedFixtureGroupKey=1_abcbcbcbc&selectedDateCode=all&selectedRelatedFixtureOption=1&previousSelectedFixtureGroupKey=1_abcbcbcbc&itemsPerPage=10000';
        $expectedResponse = file_get_contents(__DIR__ . '/../Examples/example_results.html');

        $clientMock = $this->createMock(FullTimeClient::class);
        $clientMock->expects($this->once())
            ->method('get')
            ->with($expectedUrl)
            ->willReturn($expectedResponse);

        $results = new Results($clientMock);

        $resultData = $results->getResults($seasonId, $groupId);

        $this->assertIsArray($resultData);
        $this->assertEquals($this->expectedArray(), $resultData);
    }

    private function expectedArray(): array
    {
        return
            [
                ["29/05/21 09:30", "Mill Hill Juniors - Red U14S", "0 - 2", "Wilpshire Wanderers - Blue U14S", "SURRIDGE SPORTS U14S CUP 2020 - 2021"],
                ["22/05/21 11:30", "Wilpshire Wanderers - Red U14S", "2 - 2", "Rosegrove FC - Warriors U14S", "UNDER 14S"],
                ["15/05/21 11:45", "Junior Gardeners FC - U14S", "1 - 3", "Rossendale United JFC - Royals U14S", "UNDER 14S"],
                ["15/05/21 11:00", "Mill Hill Juniors - Red U14S", "5 - 1", "Rosegrove FC - Warriors U14S", "UNDER 14S"],
                ["15/05/21 10:45", "Langho Juniors - U14S", "5 - 1", "Rossendale Valley - Wasps U14S", "UNDER 14S"]
            ];
    }
}
