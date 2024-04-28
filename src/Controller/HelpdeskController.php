<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class HelpdeskController extends AbstractController
{
    public function __construct(
        #[TaggedIterator('integration')] private iterable $integrations,
        private MessageBusInterface $messageBus,
    ) {
    }

    #[Route('/get-orders/{integration}', name: 'get_orders')]
    public function index(): Response
    {
        foreach ($this->integrations as $integration) {
            dump($integration);
//            $this->messageBus->dispatch(new YourIntegrationMessage($integration));
        }

        return $this->render('helpdesk/index.html.twig', []);
    }
}
