<?php
declare(strict_types=1);

namespace App\Common\Application\IntegrationEvent;

use App\Common\Domain\DomainEvent;
use DateTimeImmutable;

interface IntegrationEvent
{
    public function getUuid(): string;
    public function getOccurredAt(): DateTimeImmutable;
    public static function basedOn(): string;
    public static function build(DomainEvent $domainEvent): static;
}
