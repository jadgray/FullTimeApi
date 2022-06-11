<?php

namespace Tests\DataFormatters;

use Jadgray\FullTimeApi\DataFormatters\FixtureFormatter;
use PHPUnit\Framework\TestCase;

class FixtureFormatterTest extends TestCase
{
    /**
     * @return void
     */
    public function testArrayIsFormattedCorrectly(): void
    {
        $fixtureFormatter = new FixtureFormatter();

        $this->assertEquals(
            $this->getFormattedFixtures(),
            $fixtureFormatter->formatFixtures($this->getUnFormattedFixtures())
        );
    }

    /**
     * @return array
     */
    private function getUnFormattedFixtures(): array
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
                'Cup',
                '12/01/22 13:00',
                'Woods FC - Yellow U7S',
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

    /**
     * @return array
     */
    private function getFormattedFixtures(): array
    {
        return [
            [
                'Date' => '05/02/2022',
                'Home' => 'Rosegrove FC - Rangers U7S',
                'Away' => 'Rossendale United - Yellow U7S',
                'Time' => '09:10',
                'FixtureType' => 'L',
            ],
            [
                'Date' => '12/03/2022',
                'Home' => 'Rossendale United - Yellow U7S',
                'Away' => 'Junior Hoops JFC - Cobras U7S',
                'Time' => '09:55',
                'FixtureType' => 'L'
            ],
            [
                'Date' => '12/01/2022',
                'Home' => 'Woods FC - Yellow U7S',
                'Away' => 'Junior Hoops JFC - Cobras U7S',
                'Time' => '13:00',
                'FixtureType' => 'Cup'
            ],
        ];
    }
}