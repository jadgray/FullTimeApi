<?php

namespace Jadgray\FullTimeApi\Helpers;

class StringHelper
{
    public static function removeWhitespace(string $text): string
    {
        $trimmedText = trim($text);
        $normalizedText = str_replace(["\n", "\r"], '', $trimmedText);

        // Replace multiple spaces with a single space
        return preg_replace('/\s+/', ' ', $normalizedText);
    }
}