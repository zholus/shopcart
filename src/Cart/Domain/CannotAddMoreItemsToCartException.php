<?php
declare(strict_types=1);

namespace App\Cart\Domain;

use DomainException;

final class CannotAddMoreItemsToCartException extends DomainException
{
    public static function withExternalId(int $id): self
    {
        return new self(
            sprintf('Cannot add more than 3 items with id [%d] to cart', $id)
        );
    }
}
