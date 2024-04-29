<?php

declare(strict_types=1);

namespace App\Message;

class AllOrders
{
    public function __construct(
        private array $data,
    ) {
    }

    public function getData(): array
    {
        return $this->data;
    }
}
