<?php
declare(strict_types=1);

namespace App\Cart\Domain;

use DomainException;

final class CartNotFoundException extends DomainException
{
    public static function withId(CartId $id): self
    {
        return new self(sprintf('Cart with id [%s] not found', $id->getId()));
    }
}
