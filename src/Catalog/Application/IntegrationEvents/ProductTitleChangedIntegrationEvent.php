<?php
declare(strict_types=1);

namespace App\Catalog\Application\IntegrationEvents;

use App\Catalog\Domain\TitleChanged;
use App\Common\Application\IntegrationEvent\IntegrationEvent;
use App\Common\Domain\DomainEvent;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;

final class ProductTitleChangedIntegrationEvent implements IntegrationEvent
{
    public function __construct(
        private string $uuid,
        private int $productId,
        private string $oldTitle,
        private string $newTitle,
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

    public function getOldTitle(): string
    {
        return $this->oldTitle;
    }

    public function getNewTitle(): string
    {
        return $this->newTitle;
    }

    public function getOccurredAt(): DateTimeImmutable
    {
        return $this->occurredAt;
    }

    public static function basedOn(): string
    {
        return TitleChanged::class;
    }

    /** @param TitleChanged $domainEvent */
    public static function build(DomainEvent $domainEvent): static
    {
        return new self(
            Uuid::uuid4()->toString(),
            $domainEvent->getProductId()->getId(),
            $domainEvent->getOldTitle(),
            $domainEvent->getNewTitle(),
            new DateTimeImmutable()
        );
    }
}
