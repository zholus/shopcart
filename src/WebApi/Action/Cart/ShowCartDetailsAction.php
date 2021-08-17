<?php
declare(strict_types=1);

namespace App\WebApi\Action\Cart;

use App\Cart\Application\GetCartDetailsById\GetCartDetailsByIdQuery;
use App\Cart\Application\ReadModel\Cart as CartReadModel;
use App\Common\Application\Query\QueryBus;
use App\WebApi\Resources\Cart\Cart;
use App\WebApi\Resources\Cart\CartPresenter;
use App\WebApi\Resources\Cart\Product;
use App\WebApi\Resources\Cart\ProductsList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class ShowCartDetailsAction extends AbstractController
{
    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(string $cartId): Response
    {
        /** @var CartReadModel $cart */
        $cartReadModel = $this->queryBus->handle(new GetCartDetailsByIdQuery($cartId));

        $cart = new Cart($cartId, $this->mapToProductList($cartReadModel));

        $presenter = new CartPresenter($cart);
        return new JsonResponse($presenter->present());
    }

    private function mapToProductList(object $cartReadModel): ProductsList
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
