<?php
declare(strict_types=1);

namespace App\WebApi\Action\Cart;

use App\WebApi\Resources\Cart\Cart;
use App\WebApi\Resources\Cart\CartPresenter;
use App\WebApi\Resources\Cart\Product;
use App\WebApi\Resources\Cart\ProductsList;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class ShowProductListAction extends AbstractController
{
    public function __invoke(): Response
    {
        $cart = new Cart(
            Uuid::uuid4()->toString(),
            new ProductsList(
                new Product(1, 'GTA', 22354, 1),
                new Product(2, 'Mafia', 13134, 2),
                new Product(3, 'The Sims', 9212, 3),
            )
        );

        $presenter = new CartPresenter($cart);
        return new JsonResponse($presenter->present());
    }
}
