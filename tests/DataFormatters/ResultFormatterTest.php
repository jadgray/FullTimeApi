<?php

namespace Tests\DataFormatters;

use Jadgray\FullTimeApi\DataFormatters\ResultFormatter;
use PHPUnit\Framework\TestCase;

class ResultFormatterTest extends TestCase
{
    /**
     * @return void
     */
    public function testArrayIsFormattedCorrectly(): void
    {
        $resultFormatter = new ResultFormatter();

        $this->assertEquals(
            $this->getFormattedResults(),
            $resultFormatter->formatResults($this->getUnFormattedResults())
        );
    }

    /**
     * @return array
     */
    private function getUnFormattedResults(): array
    {
        return [
            ["29/05/21 09:30", "Mill Hill Juniors - Red U14S", "0 - 2", "Wilpshire Wanderers - Blue U14S", "SURRIDGE SPORTS U14S CUP 2020 - 2021"],
            ["22/05/21 11:30", "Wilpshire Wanderers - Red U14S", "2 - 2", "Rosegrove FC - Warriors U14S", "UNDER 14S"],
            ["15/05/21 11:45", "Junior Gardeners FC - U14S", "1 - 3", "Rossendale United JFC - Royals U14S", "UNDER 14S"],
            ["15/05/21 11:00", "Mill Hill Juniors - Red U14S", "5 - 1", "Rosegrove FC - Warriors U14S", "UNDER 14S"],
            ["15/05/21 10:45", "Langho Juniors - U14S", "5 - 1", "Rossendale Valley - Wasps U14S", "UNDER 14S"]
        ];
    }

    /**
     * @return array
     */
    private function getFormattedResults(): array
    {
        return [
            [
                'Date' => '29/05/2021',
                'Time' => '09:30',
                'Home' => 'Mill Hill Juniors - Red U14S',
                'HomeScore' => '0',
                'Away' => 'Wilpshire Wanderers - Blue U14S',
                'AwayScore' => '2',
                'FullScore' => '0 - 2',
            ],
            [
                'Date' => '22/05/2021',
                'Time' => '11:30',
                'Home' => 'Wilpshire Wanderers - Red U14S',
                'HomeScore' => '2',
                'Away' => 'Rosegrove FC - Warriors U14S',
                'AwayScore' => '2',
                'FullScore' => '2 - 2',
            ],
            [
                'Date' => '15/05/2021',
                'Time' => '11:45',
                'Home' => 'Junior Gardeners FC - U14S',
                'HomeScore' => '1',
                'Away' => 'Rossendale United JFC - Royals U14S',
                'AwayScore' => '3',
                'FullScore' => '1 - 3',
            ],
            [
                'Date' => '15/05/2021',
                'Time' => '11:00',
                'Home' => 'Mill Hill Juniors - Red U14S',
                'HomeScore' => '5',
                'Away' => 'Rosegrove FC - Warriors U14S',
                'AwayScore' => '1',
                'FullScore' => '5 - 1',
            ],
            [
                'Date' => '15/05/2021',
                'Time' => '10:45',
                'Home' => 'Langho Juniors - U14S',
                'HomeScore' => '5',
                'Away' => 'Rossendale Valley - Wasps U14S',
                'AwayScore' => '1',
                'FullScore' => '5 - 1',
            ],
        ];
    }
}