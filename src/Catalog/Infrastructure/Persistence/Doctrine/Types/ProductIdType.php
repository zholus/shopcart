<?php
declare(strict_types=1);

namespace App\Catalog\Infrastructure\Persistence\Doctrine\Types;

use App\Catalog\Domain\ProductId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

final class ProductIdType extends IntegerType
{
    private const NAME = 'ProductIdType';

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return ProductId::fromInt((int)$value);
    }

    /**
     * @param ProductId $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->getId();
    }

    public function getName()
    {
        return self::NAME;
    }
}
