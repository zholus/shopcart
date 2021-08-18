<?php
declare(strict_types=1);

namespace App\Catalog\Application\IntegrationEvents;

use App\Catalog\Domain\ProductDeleted;
use App\Common\Application\IntegrationEvent\IntegrationEvent;
use App\Common\Domain\DomainEvent;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;

final class ProductDeletedIntegrationEvent implements IntegrationEvent
{
    public function __construct(
        private string $uuid,
        private int $productId,
        private string $title,
        private int $price,
        private DateTimeImmutable $occurredAt
    ) {
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getOccurredAt(): DateTimeImmutable
    {
        return $this->occurredAt;
    }

    public static function basedOn(): string
    {
        return ProductDeleted::class;
    }

    /**
     * @param ProductDeleted $domainEvent
     */
    public static function build(DomainEvent $domainEvent): static
    {
        return new self(
            Uuid::uuid4()->toString(),
            $domainEvent->getProductId()->getId(),
            $domainEvent->getTitle(),
            (int)$domainEvent->getPrice()->getAmount(),
            new DateTimeImmutable()
        );
    }
}
