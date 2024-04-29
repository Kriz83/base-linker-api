<?php

declare(strict_types=1);

namespace App\Tests\Api;

use App\Api\BaselinkerClient;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Uri;
use PHPUnit\Framework\TestCase;

class BaselinkerClientTest extends TestCase
{
    public function testConstructorSetsToken(): void
    {
        $expectedToken = 'test_token';
        $client = new BaselinkerClient($expectedToken);
        $actualToken = $this->getObjectAttribute($client, 'token');

        $this->assertSame($expectedToken, $actualToken);
    }

    public function testSetClientCreatesHttpClient(): void
    {
        $client = new BaselinkerClient('test_token');
        $client->setClient();
        $this->assertInstanceOf(Client::class, $this->getObjectAttribute($client, 'httpClient'));
    }

    public function testSetClientSetsBaseUriAndHeaders(): void
    {
        $token = 'test_token';
        $client = new BaselinkerClient($token);
        $client->setClient();
        $httpClient = $this->getObjectAttribute($client, 'httpClient');
        $config = $httpClient->getConfig();

        /** @var Uri $uri */
        $uri = $config['base_uri'];

        $this->assertSame(BaselinkerClient::URL, $uri->__toString());
        $this->assertSame($token, $config['headers']['X-BLToken']);
        $this->assertSame('application/json', $config['headers']['Accept']);
    }

    public function testGetSendsGetRequest(): void
    {
        $response = new Response(200, [], '{"data": "test"}');
        $httpClient = $this->createMock(Client::class);
        $httpClient->expects($this->once())
            ->method('get')
            ->with('/endpoint', ['query' => ['param' => 'value']])
            ->willReturn($response);

        $client = new BaselinkerClient('test_token');
        $this->setObjectAttribute($client, 'httpClient', $httpClient);

        $result = $client->get('/endpoint', ['param' => 'value']);
        $this->assertSame($response, $result);
    }

    public function testPostSendsPostRequest(): void
    {
        $response = new Response(200, [], '{"data": "test"}');
        $httpClient = $this->createMock(Client::class);
        $httpClient->expects($this->once())
            ->method('post')
            ->with('/endpoint', ['json' => ['key' => 'value']])
            ->willReturn($response);

        $client = new BaselinkerClient('test_token');
        $this->setObjectAttribute($client, 'httpClient', $httpClient);

        $result = $client->post('/endpoint', ['key' => 'value']);
        $this->assertSame($response, $result);
    }

    protected function getObjectAttribute($object, $attributeName)
    {
        $reflection = new \ReflectionClass($object);
        $attribute = $reflection->getProperty($attributeName);
        return $attribute->getValue($object);
    }

    protected function setObjectAttribute($object, $attributeName, $value)
    {
        $reflection = new \ReflectionClass($object);
        $attribute = $reflection->getProperty($attributeName);
        $attribute->setValue($object, $value);
    }
}
