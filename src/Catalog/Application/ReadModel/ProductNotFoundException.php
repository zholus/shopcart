<?php
declare(strict_types=1);

namespace App\Catalog\Application\ReadModel;

use App\Common\Application\NotFoundException;
use RuntimeException;

final class ProductNotFoundException extends RuntimeException implements NotFoundException
{
    public static function byTitle(string $title): self
    {
        return new self(sprintf('Product with title [%s] not found', $title));
    }

    public static function byId(int $productId): self
    {
        return new self(sprintf('Product with id [%s] not found', $productId));
    }
}
