<?php

namespace Division;

use Jadgray\FullTimeApi\Division\Fixtures;
use Jadgray\FullTimeApi\FullTimeClient;
use Mockery;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DomCrawler\Crawler;

class FixturesTest extends TestCase
{

    /**
     * @throws Exception
     */
    public function test_getting_fixtures_from_full_time(): void
    {
        $seasonId = 2023;
        $groupId = 'groupA';
        $expectedUrl = 'https://fulltime.thefa.com/fixtures.html?selectedSeason=2023&selectedFixtureGroupKey=groupA&selectedDateCode=all&selectedRelatedFixtureOption=1&previousSelectedFixtureGroupKey=groupA&itemsPerPage=10000';
        $expectedResponse = file_get_contents(__DIR__ . '/../Examples/example_fixtures.html');

        $clientMock = $this->createMock(FullTimeClient::class);
        $clientMock->expects($this->once())
            ->method('get')
            ->with($expectedUrl)
            ->willReturn($expectedResponse);

        $fixtures = new Fixtures($clientMock);

        $fixtureData = $fixtures->getFixtures($seasonId, $groupId);

        $this->assertIsArray($fixtureData);
        $this->assertCount(7, $fixtureData);

        $expectedCounts = [10, 10, 10, 10, 10, 10, 10];

        foreach ($fixtureData as $index => $fixture) {
            $this->assertCount($expectedCounts[$index], $fixture);
        }

        $this->assertEquals($this->expectedArray(), $fixtureData);
    }

    private function expectedArray(): array
    {
        return [
            [
                'L',
                '05/02/22 09:10',
                'Rosegrove FC - Rangers U7S',
                '',
                'VS',
                '',
                'Rossendale United - Yellow U7S',
                '',
                'UNDER 07S',
                ''
            ],
            [
                'L',
                '19/02/22 11:15',
                'Blackburn Eagles JFC - Blue U7S',
                '',
                'VS',
                '',
                'Rosegrove FC - Clarets U7S',
                '',
                'UNDER 07S',
                ''
            ],
            [
                'L',
                '12/03/22 09:55',
                'Rossendale United - Yellow U7S',
                '',
                'VS',
                '',
                'Junior Hoops JFC - Cobras U7S',
                '',
                'UNDER 07S',
                ''
            ],
            [
                'L',
                '02/04/22 09:00',
                'Junior Hoops JFC - Dragons U7S',
                '',
                'VS',
                '',
                'Rossendale United - Yellow U7S',
                '',
                'UNDER 07S',
                ''
            ],
            [
                'L',
                '02/04/22 10:00',
                'Blackburn Eagles JFC - Blue U7S',
                '',
                'VS',
                '',
                'Junior Gardeners - U7S',
                '',
                'UNDER 07S',
                ''
            ],
            [
                'L',
                '09/04/22 09:00',
                'Junior Hoops JFC - Bears U7S',
                '',
                'VS',
                '',
                'Blackburn Eagles JFC - Blue U7S',
                '',
                'UNDER 07S',
                'Postponed'
            ],
            [
                'L',
                '16/04/22 09:00',
                'Junior Hoops JFC - Bears U7S',
                '',
                'VS',
                '',
                'Junior Hoops JFC - Cobras U7S',
                '',
                'UNDER 07S',
                ''
            ]
        ];
    }
}