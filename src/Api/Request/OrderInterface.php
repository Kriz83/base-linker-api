<?php

declare(strict_types=1);

namespace App\Api\Request;

use GuzzleHttp\Psr7\Response;

interface OrderInterface
{
    public function getOrders(array $data): Response;

    public function getOrdersByEmail(string $email): Response;

    public function getOrdersByPhone(string $phone): Response;
}
