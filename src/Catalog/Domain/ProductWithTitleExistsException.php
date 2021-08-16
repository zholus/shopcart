<?php
declare(strict_types=1);

namespace App\Catalog\Domain;

use DomainException;

final class ProductWithTitleExistsException extends DomainException
{
    public static function create(string $title): self
    {
        return new self(sprintf(
            'Product with title [%s] already exists',
            $title
        ));
    }
}
