<?php

declare(strict_types=1);

namespace App\Api\Request;

use App\Api\ApiHttpClientInterface;
use GuzzleHttp\Psr7\Response;

class Order implements OrderInterface
{
    const GET_ORDERS = 'getOrders';
    const GET_ORDERS_BY_EMAIL = 'getOrdersByEmail';
    const GET_ORDERS_BY_PHONE = 'getOrdersByPhone';


    public function __construct(
        private ApiHttpClientInterface $client
    ) {
    }

    public function getOrders(array $data): Response
    {
        return $this->client->post(self::GET_ORDERS, $data);
    }

    public function getOrdersByEmail(string $email): Response
    {
        return $this->client->post(
            self::GET_ORDERS_BY_EMAIL,
            [
                'email' => $email,
            ]
        );
    }

    public function getOrdersByPhone(string $phone): Response
    {
        return $this->client->post(
            self::GET_ORDERS_BY_PHONE,
            [
                'phone' => $phone,
            ]
        );
    }
}
