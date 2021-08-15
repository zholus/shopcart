<?php
declare(strict_types=1);

namespace App\WebApi\Action\Product;

use App\WebApi\Resources\Product\Product;
use App\WebApi\Resources\Product\ProductPresenter;
use App\WebApi\Resources\Product\ProductsList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class ShowProductListAction extends AbstractController
{
    public function __invoke(): JsonResponse
    {
        $list = new ProductsList(
            new Product(1, 'GTA', 25600),
            new Product(2, 'Mafia', 11300)
        );

        return new JsonResponse(array_map(
            fn(Product $product) => (new ProductPresenter($product))->present(),
            $list->getProducts()
        ));
    }
}
