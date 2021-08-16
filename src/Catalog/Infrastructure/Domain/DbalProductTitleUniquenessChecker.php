<?php
declare(strict_types=1);

namespace App\Catalog\Infrastructure\Domain;

use App\Catalog\Domain\ProductId;
use App\Catalog\Domain\ProductTitleUniquenessChecker;
use Doctrine\DBAL\Connection;

final class DbalProductTitleUniquenessChecker implements ProductTitleUniquenessChecker
{
    public function __construct(private Connection $connection)
    {
    }

    public function isUnique(string $title): bool
    {
        $qb = $this->connection->createQueryBuilder();

        $qb->select('1')
            ->from('products', 'p')
            ->where('p.title = :TITLE')
            ->setParameter(':TITLE', $title);

        $result = $qb->execute();

        return $result->rowCount() === 0;
    }
}
