<?php

namespace Tests;

use Jadgray\FullTimeApi\Division\Teams;
use Mockery;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DomCrawler\Crawler;

class TeamTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $example_file = file_get_contents(__DIR__ . '/../Examples/example_fixtures.html');

        $this->crawler = new Crawler($example_file);
    }

    public function testGettingTeamsFromFullTime(): void
    {
        $getTeams = Mockery::mock(Teams::class);

        $getTeams->shouldReceive('getTeams')->andReturn($this->crawler);

        $teams = $getTeams->getTeams(1, 1);

        $this->assertEquals(Crawler::class, get_class($teams));
    }

    public function testTheExtractionOfTeamsFromExample(): void
    {
        $teamClass = new Teams();

        $teams = $teamClass->extractTeams($this->crawler);

        $this->assertEquals($this->expectedTeamsArray(), $teams);
    }

    private function expectedTeamsArray(): array
    {
        return
            [
                ["All"],
                ["Blackburn Eagles JFC - Blue U7S"],
                ["Junior Gardeners - U7S"],
                ["Junior Hoops JFC - Bears U7S"],
                ["Junior Hoops JFC - Cobras U7S"],
                ["Junior Hoops JFC - Dragons U7S"],
                ["Rosegrove FC - Clarets U7S"],
                ["Rosegrove FC - Rangers U7S"],
                ["Rossendale United - Yellow U7S"]
            ];
    }
}