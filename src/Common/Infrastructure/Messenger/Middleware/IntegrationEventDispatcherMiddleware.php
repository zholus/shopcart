<?php
declare(strict_types=1);

namespace App\Common\Infrastructure\Messenger\Middleware;

use App\Common\Application\Event\EventBus;
use App\Common\Application\IntegrationEvent\IntegrationEvents;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;

final class IntegrationEventDispatcherMiddleware implements MiddlewareInterface
{
    public function __construct(private EventBus $eventBus, private IntegrationEventsLocator $integrationEventsLocator)
    {
    }

    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        $envelope = $stack->next()->handle($envelope, $stack);

        $domainEvents = IntegrationEvents::getPublishedDomainEvents();
        IntegrationEvents::clearPublishedDomainEvents();

        foreach ($domainEvents as $domainEvent) {
            $integrationEventsClassNames = $this->integrationEventsLocator->getByDomainEventClassName(get_class($domainEvent));

            foreach ($integrationEventsClassNames as $integrationEventClassName) {
                $integrationEvent = $integrationEventClassName::build($domainEvent);

                $this->eventBus->dispatch($integrationEvent);
            }
        }

        return $envelope;
    }
}
