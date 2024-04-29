<?php

declare(strict_types=1);

namespace App\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class BaselinkerClient implements ApiHttpClientInterface
{
    public const URL = 'https://api.baselinker.com/';

    private ?Client $httpClient = null;

    public function __construct(private string $token)
    {
        $this->setClient();
    }

    public function get(
        string $endpoint,
        array $queryParams = []
    ): Response {
        return $this->httpClient->get(
            $endpoint,
            ['query' => $queryParams],
        );
    }

    public function post(
        string $endpoint,
        array $data
    ): Response {
        return $this->httpClient->post(
            $endpoint,
            ['json' => $data],
        );
    }

    public function setClient(): void
    {
        if (null === $this->httpClient) {
            $this->httpClient = new Client([
                'base_uri' => self::URL,
                'headers' => [
                    'X-BLToken' => $this->token,
                    'Accept' => 'application/json',
                ],
            ]);
        }
    }
}
