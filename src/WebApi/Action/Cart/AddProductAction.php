<?php
declare(strict_types=1);

namespace App\WebApi\Action\Cart;

use App\Cart\Application\AddItemToCart\AddItemToCartCommand;
use App\Cart\Application\GetCartDetailsById\GetCartDetailsByIdQuery;
use App\Cart\Application\ReadModel\Cart as CartReadModel;
use App\Catalog\Application\GetProductDetailsById\GetProductDetailsByIdQuery;
use App\Catalog\Application\ReadModel\Product as ProductReadModel;
use App\Common\Application\Command\CommandBus;
use App\Common\Application\Query\QueryBus;
use App\WebApi\Resources\Cart\Cart;
use App\WebApi\Resources\Cart\CartPresenter;
use App\WebApi\Resources\Cart\Product;
use App\WebApi\Resources\Cart\ProductsList;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class AddProductAction extends AbstractController
{
    public function __construct(private CommandBus $commandBus, private QueryBus $queryBus)
    {
    }

    public function __invoke(string $cartId, int $productId, Request $request): Response
    {
        $itemId = Uuid::uuid4()->toString();

        /** @var ProductReadModel $product */
        $product = $this->queryBus->handle(new GetProductDetailsByIdQuery($productId));

        $this->commandBus->dispatch(new AddItemToCartCommand(
            $cartId,
            $itemId,
            $productId,
            $product->getTitle(),
            $product->getPrice()
        ));

        /** @var CartReadModel $cartReadModel */
        $cartReadModel = $this->queryBus->handle(new GetCartDetailsByIdQuery($cartId));

        $cart = new Cart($cartId, $this->mapToProductList($cartReadModel));

        $presenter = new CartPresenter($cart);

        return new JsonResponse($presenter->present(), Response::HTTP_CREATED);
    }

    private function mapToProductList(CartReadModel $cartReadModel): ProductsList
    {
        $products = [];

        foreach ($cartReadModel->getItems() as $item) {
            $products[] = new Product(
                $item->getExternalId(),
                $item->getTitle(),
                $item->getPrice()
            );
        }

        return new ProductsList(...$products);
    }
}
