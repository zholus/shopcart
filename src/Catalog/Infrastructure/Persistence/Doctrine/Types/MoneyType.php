<?php
declare(strict_types=1);

namespace App\Catalog\Infrastructure\Persistence\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;
use Money\Money;

final class MoneyType extends IntegerType
{
    private const NAME = 'MoneyType';

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return Money::USD($value);
    }

    /**
     * @param Money $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return (int)$value->getAmount();
    }

    public function getName()
    {
        return self::NAME;
    }
}