<?php
declare(strict_types=1);

namespace App\Catalog\Domain;

use DomainException;

final class ProductNotFoundException extends DomainException
{
    public static function withId(ProductId $id): self
    {
        return new self(sprintf(
            'Product with id [%d] not found',
            $id->getId()
        ));
    }
}
