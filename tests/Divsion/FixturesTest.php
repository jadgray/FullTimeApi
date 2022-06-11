<?php

namespace Tests;

use Jadgray\FullTimeApi\Division\Fixtures;
use Mockery;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DomCrawler\Crawler;

class FixturesTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $example_file = file_get_contents(__DIR__ . '/../Examples/example_fixtures.html');

        $this->crawler = new Crawler($example_file);
    }

    public function testGettingFixturesFromFullTime(): void
    {
        $getFixtures = Mockery::mock(Fixtures::class);

        $getFixtures->shouldReceive('getFixtures')->andReturn($this->crawler);

        $fixtures = $getFixtures->getFixtures(1, 1);

        $this->assertEquals(Crawler::class, get_class($fixtures));
    }

    public function testTheExtractionOfFixturesFromExample(): void
    {
        $fixtureClass = new Fixtures();

        $fixtures = $fixtureClass->extractFixtures($this->crawler);

        $this->assertEquals($this->expectedArray(), $fixtures);
    }

    private function expectedArray(): array
    {
        return [
            [],
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