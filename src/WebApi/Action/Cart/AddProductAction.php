<?php
declare(strict_types=1);

namespace App\WebApi\Action\Cart;

use App\WebApi\Resources\Cart\Cart;
use App\WebApi\Resources\Cart\CartPresenter;
use App\WebApi\Resources\Cart\ProductsList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class AddProductAction extends AbstractController
{
    public function __invoke(): Response
    {
        $cart = new Cart(1, new ProductsList());

        $presenter = new CartPresenter($cart);

        return new JsonResponse($presenter->present(), Response::HTTP_CREATED);
    }
}
