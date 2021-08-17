<?php
declare(strict_types=1);

namespace App\WebApi\Action\Product;

use App\Catalog\Application\GetProductsPaginated\GetProductsPaginatedQuery;
use App\Catalog\Application\ReadModel\ProductPaginated;
use App\Common\Application\Query\QueryBus;
use App\WebApi\Resources\Product\Product;
use App\WebApi\Resources\Product\ProductPresenter;
use App\WebApi\Resources\Product\ProductsList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ShowProductListAction extends AbstractController
{
    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $page = (int)$request->get('page', 1);

        /** @var ProductPaginated $productPaginated */
        $productPaginated = $this->queryBus->handle(new GetProductsPaginatedQuery($page));

        $products = [];

        foreach ($productPaginated->getProducts() as $product) {
            $products[] = new Product(
                $product->getProductId(),
                $product->getTitle(),
                $product->getPrice()
            );
        }

        $list = new ProductsList(
            ...$products
        );

        return new JsonResponse(array_map(
            fn(Product $product) => (new ProductPresenter($product))->present(),
            $list->getProducts()
        ), Response::HTTP_OK, [
            'x-pagination-total-items' => $productPaginated->getPaginationData()->getTotalItems(),
            'x-pagination-total-pages' => $productPaginated->getPaginationData()->getTotalPages(),
            'x-pagination-current-page' => $productPaginated->getPaginationData()->getCurrentPage(),
            'x-pagination-per-page' => $productPaginated->getPaginationData()->getPerPage(),
        ]);
    }
}
