<?php

namespace Helpers;

use Jadgray\FullTimeApi\Helpers\StringHelper;
use PHPUnit\Framework\TestCase;

class StringHelperTest extends TestCase
{
    public function test_it_removes_whitespace_from_a_string(): void
    {
        $text = "  This is a string with  \n  whitespace  \r  ";
        $expected = "This is a string with whitespace";

        $result = StringHelper::removeWhitespace($text);

        $this->assertEquals($expected, $result);
    }

    public function test_it_removes_multiple_spaces_from_a_string(): void
    {
        $text = "This   is   a   string   with   multiple   spaces";
        $expected = "This is a string with multiple spaces";

        $result = StringHelper::removeWhitespace($text);

        $this->assertEquals($expected, $result);
    }

    public function test_it_removes_whitespace_from_a_string_with_no_whitespace(): void
    {
        $text = "This is a string with no whitespace";
        $expected = "This is a string with no whitespace";

        $result = StringHelper::removeWhitespace($text);

        $this->assertEquals($expected, $result);
    }

    public function test_it_removes_whitespace_from_a_string_with_only_whitespace(): void
    {
        $text = "  \n  \r  ";
        $expected = "";

        $result = StringHelper::removeWhitespace($text);

        $this->assertEquals($expected, $result);
    }
}