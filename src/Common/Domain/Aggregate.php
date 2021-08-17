<?php
declare(strict_types=1);

namespace App\Common\Domain;

abstract class Aggregate
{
    protected function publishDomainEvent(DomainEvent $domainEvent): void
    {
        DomainEvents::publishEvent($domainEvent);
    }
}
