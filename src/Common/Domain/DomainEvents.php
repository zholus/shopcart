<?php
declare(strict_types=1);

namespace App\Common\Domain;

class DomainEvents
{
    private static array $events = [];

    public static function publishEvent(DomainEvent $domainEvent): void
    {
        self::$events[] = $domainEvent;
    }

    public static function getEvents(): array
    {
        return self::$events;
    }

    public static function clear(): void
    {
        self::$events = [];
    }
}
