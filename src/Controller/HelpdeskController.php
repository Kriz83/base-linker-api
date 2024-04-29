<?php

declare(strict_types=1);

namespace App\Controller;

use App\Api\Integration\IntegrationStrategyInterface;
use App\Message\AllOrders;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class HelpdeskController extends AbstractController
{
    public function __construct(
        private MessageBusInterface $messageBus,
        private IntegrationStrategyInterface $integrationStrategy,
    ) {
    }

    #[Route('/get-orders/{integration}', name: 'get_orders')]
    public function index(string $integration): Response
    {
        $data = [];
        $integration = $this->integrationStrategy->resolveIntegration($integration);

        if (null !== $integration) {
            $data = [
                'integrationName' => $integration->getIntegrationName(),
            ];
        }

        $this->messageBus->dispatch(new AllOrders($data));

        return $this->render('helpdesk/index.html.twig', []);
    }
}
