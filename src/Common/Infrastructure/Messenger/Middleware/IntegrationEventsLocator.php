<?php
declare(strict_types=1);

namespace App\Common\Infrastructure\Messenger\Middleware;

use App\Common\Application\IntegrationEvent\IntegrationEvent;

final class IntegrationEventsLocator
{
    private array $events = [];

    /**
     * @param string|IntegrationEvent $integrationEventClassName
     */
    public function add(string $integrationEventClassName): void
    {
        $basedOn = $integrationEventClassName::basedOn();

        if (null === $basedOn) {
            return;
        }

        if (isset($this->events[$basedOn])) {
            $this->events[$basedOn][] = $integrationEventClassName;
        } else {
            $this->events[$basedOn] = [$integrationEventClassName];
        }
    }

    /**
     * @return IntegrationEvent[]|string[] return integration event class name
     */
    public function getByDomainEventClassName(string $domainEventClassName): array
    {
        return $this->events[$domainEventClassName] ?? [];
    }

}
