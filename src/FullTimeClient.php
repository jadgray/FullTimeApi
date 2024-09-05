<?php

namespace Jadgray\FullTimeApi;

use RuntimeException;

class FullTimeClient
{
    public function get(string $url, array $params = []): string
    {
        $url = $this->buildUrl($url, $params);
        $response = @file_get_contents($url);

        if ($response === false) {
            $error = error_get_last();
            $message = $error['message'] ?? "Failed to fetch data from {$url}";
            throw new RuntimeException($message);
        }

        return $response;
    }

    private function buildUrl(string $url, array $params): string
    {
        if ( ! empty($params)) {
            $queryString = http_build_query($params);
            $url .= '?' . $queryString;
        }

        return $url;
    }
}
