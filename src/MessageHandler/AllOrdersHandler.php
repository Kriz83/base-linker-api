<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Api\Request\OrderInterface;
use App\Message\AllOrders;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class AllOrdersHandler
{
    public function __construct(
        private OrderInterface $order,
    ) {
    }

    public function __invoke(AllOrders $message): void
    {
        try {
            $this->order->getOrders($message->getData());
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
