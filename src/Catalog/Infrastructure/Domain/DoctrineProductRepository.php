<?php
declare(strict_types=1);

namespace App\Catalog\Infrastructure\Domain;

use App\Catalog\Domain\Product;
use App\Catalog\Domain\ProductId;
use App\Catalog\Domain\ProductNotFoundException;
use App\Catalog\Domain\ProductRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;

final class DoctrineProductRepository extends ServiceEntityRepository implements ProductRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function add(Product $product): void
    {
        $this->getEntityManager()->transactional(static function (EntityManager $entityManager) use ($product) {
            $entityManager->persist($product);
        });
    }

    public function findById(ProductId $productId): Product
    {
        $product = $this->find($productId);

        if ($product === null) {
            throw ProductNotFoundException::withId($productId);
        }

        return $product;
    }

    public function remove(Product $product): void
    {
        $this->getEntityManager()->remove($product);
    }
}
