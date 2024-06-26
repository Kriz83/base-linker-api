<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Api\Request\OrderInterface;
use App\Message\AllOrders;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class AllOrdersHandler
{
    public function __construct(
        private OrderInterface $order,
        private LoggerInterface $logger,
    ) {
    }

    public function __invoke(AllOrders $message): void
    {
        try {
            $this->order->getOrders($message->getData());
        } catch (\Exception $e) {
            $this->logger->error(
                "Error while getting orders: {$e->getMessage()}"
            );
        }
    }
}
