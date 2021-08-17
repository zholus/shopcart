<?php
declare(strict_types=1);

namespace App\Catalog\Infrastructure\Application\ReadModel;

use App\Catalog\Application\ReadModel\PaginationData;
use App\Catalog\Application\ReadModel\Product;
use App\Catalog\Application\ReadModel\ProductNotFoundException;
use App\Catalog\Application\ReadModel\ProductPaginated;
use App\Catalog\Application\ReadModel\ProductReadModel;
use Doctrine\DBAL\Connection;

final class DbalProductReadModel implements ProductReadModel
{
    private const PER_PAGE_LIMIT = 3;

    public function __construct(private Connection $connection)
    {
    }

    public function findAllPaginated(int $page = 1): ProductPaginated
    {
        $offset = ($page - 1) * self::PER_PAGE_LIMIT;

        $qb = $this->connection->createQueryBuilder();

        $result = $qb->select('count(*)')
            ->from('products')
            ->execute();

        $countResult = $result->fetchOne();
        $totalCount = $countResult === false
            ? 0
            : (int)$countResult;

        $result = $qb->select('id', 'title', 'price')
            ->from('products')
            ->setMaxResults(self::PER_PAGE_LIMIT)
            ->setFirstResult($offset)
            ->execute();

        $products = [];

        foreach ($result->fetchAllAssociative() as $row) {
            $products[] = $this->fromRow($row);
        }

        return new ProductPaginated(
            new PaginationData(
                $totalCount,
                self::PER_PAGE_LIMIT,
                $page,
                (int)ceil($totalCount / self::PER_PAGE_LIMIT)
            ),
            ...$products
        );
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
            throw ProductNotFoundException::byTitle($title);
        }

        return $this->fromRow($row);
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
            throw ProductNotFoundException::byId($productId);
        }

        return $this->fromRow($row);
    }

    private function fromRow(array $row): Product
    {
        return new Product(
            (int)$row['id'],
            $row['title'],
            (int)$row['price'],
        );
    }
}
