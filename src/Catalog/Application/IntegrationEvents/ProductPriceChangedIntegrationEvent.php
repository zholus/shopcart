<?php
declare(strict_types=1);

namespace App\Catalog\Application\IntegrationEvents;

use App\Catalog\Domain\PriceChanged;
use App\Common\Application\IntegrationEvent\IntegrationEvent;
use App\Common\Domain\DomainEvent;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;

final class ProductPriceChangedIntegrationEvent implements IntegrationEvent
{
    public function __construct(
        private string $uuid,
        private int $productId,
        private int $oldPrice,
        private int $newPrice,
        private DateTimeImmutable $occurredAt
    ) {
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getOldPrice(): int
    {
        return $this->oldPrice;
    }

    public function getNewPrice(): int
    {
        return $this->newPrice;
    }

    public function getOccurredAt(): DateTimeImmutable
    {
        return $this->occurredAt;
    }

    public static function basedOn(): string
    {
        return PriceChanged::class;
    }

    /** @param PriceChanged $domainEvent */
    public static function build(DomainEvent $domainEvent): static
    {
        return new self(
            Uuid::uuid4()->toString(),
            $domainEvent->getProductId()->getId(),
            (int)$domainEvent->getOldPrice()->getAmount(),
            (int)$domainEvent->getNewPrice()->getAmount(),
            new DateTimeImmutable()
        );
    }
}
