<?php

declare(strict_types=1);

namespace App\Api;

use GuzzleHttp\Psr7\Response;

interface ApiHttpClientInterface
{
    public function get(
        string $endpoint,
        array $queryParams = []
    ): Response;

    public function post(
        string $endpoint,
        array $data
    ): Response;
}
