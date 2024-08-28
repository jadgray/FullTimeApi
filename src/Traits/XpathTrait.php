<?php

namespace Jadgray\FullTimeApi\Traits;

use DOMDocument;
use DOMXPath;

trait XpathTrait
{
    private function createDomXPath(string $body): DOMXPath
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($body);
        libxml_clear_errors();

        return new DOMXPath($dom);
    }
}
