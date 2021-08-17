<?php
declare(strict_types=1);

namespace App\Common\Application\IntegrationEvent;

class IntegrationEvents
{
    private static array $domainEvents = [];

    public static function addPublishedDomainEvents(array $domainEvents): void
    {
        self::$domainEvents = array_merge(self::$domainEvents, $domainEvents);
    }

    public static function getPublishedDomainEvents(): array
    {
        return self::$domainEvents;
    }

    public static function clearPublishedDomainEvents(): void
    {
        self::$domainEvents = [];
    }
}
