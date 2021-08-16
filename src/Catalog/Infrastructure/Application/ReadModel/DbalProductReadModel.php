<?php
declare(strict_types=1);

namespace App\Catalog\Infrastructure\Application\ReadModel;

use App\Catalog\Application\ReadModel\Product;
use App\Catalog\Application\ReadModel\ProductReadModel;
use Doctrine\DBAL\Connection;

final class DbalProductReadModel implements ProductReadModel
{
    public function __construct(private Connection $connection)
    {
    }

    public function findByTitle(string $title): Product
    {
        $qb = $this->connection->createQueryBuilder();

        $result = $qb->select('id', 'title', 'price')
            ->from('products')
            ->where('title = :TITLE')
            ->setParameter(':TITLE', $title)
            ->execute();

        $row = $result->fetchAssociative();

        if ($row === false) {
            //
        }

        return new Product(
            (int)$row['id'],
            $row['title'],
            (int)$row['price'],
        );
    }

    public function findById(int $productId): Product
    {
        $qb = $this->connection->createQueryBuilder();

        $result = $qb->select('id', 'title', 'price')
            ->from('products')
            ->where('id = :ID')
            ->setParameter(':ID', $productId)
            ->execute();

        $row = $result->fetchAssociative();

        if ($row === false) {
            //
        }

        return new Product(
            (int)$row['id'],
            $row['title'],
            (int)$row['price'],
        );
    }
}
