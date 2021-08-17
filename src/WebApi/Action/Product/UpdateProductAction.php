<?php
declare(strict_types=1);

namespace App\WebApi\Action\Product;

use App\Catalog\Application\ChangeProduct\ChangeProductCommand;
use App\Catalog\Application\GetProductDetailsById\GetProductDetailsByIdQuery;
use App\Common\Application\Command\CommandBus;
use App\Common\Application\Query\QueryBus;
use App\WebApi\Resources\Product\Product;
use App\WebApi\Resources\Product\ProductPresenter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class UpdateProductAction extends AbstractController
{
    public function __construct(
        private CommandBus $commandBus,
        private QueryBus $queryBus
    ) {
    }

    public function __invoke(int $productId, Request $request): Response
    {
        $title = $request->get('title');
        $price = $request->get('price');

        if ($price !== null) {
            $price = (int)$price;
        }

        $this->commandBus->dispatch(new ChangeProductCommand($productId, $title, $price));

        /** @var \App\Catalog\Application\ReadModel\Product $product */
        $product = $this->queryBus->handle(new GetProductDetailsByIdQuery($productId));

        $product = new Product(
            $product->getProductId(),
            $product->getTitle(),
            $product->getPrice()
        );

        $presenter = new ProductPresenter($product);

        return new JsonResponse($presenter->present());
    }
}
