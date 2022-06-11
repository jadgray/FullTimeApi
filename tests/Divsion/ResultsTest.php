<?php

namespace Tests;

use Jadgray\FullTimeApi\Division\Results;
use Mockery;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DomCrawler\Crawler;

class ResultsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $example_file = file_get_contents(__DIR__ . '/../Examples/example_results.html');

        $this->crawler = new Crawler($example_file);
    }

    public function testGettingFixturesFromFullTime(): void
    {
        $getResults = Mockery::mock(Results::class);

        $getResults->shouldReceive('getResults')->andReturn($this->crawler);

        $results = $getResults->getResults(1, 1);

        $this->assertEquals(Crawler::class, get_class($results));
    }

    public function testTheExtractionOfResultsFromExample(): void
    {
        $resultClass = new Results();

        $results = $resultClass->extractResults($this->crawler);

        $this->assertEquals($this->expectedArray(), $results);
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