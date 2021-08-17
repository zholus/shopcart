<?php
declare(strict_types=1);

namespace App\WebApi\Action\Cart;

use App\Cart\Application\CreateCart\CreateCartCommand;
use App\Common\Application\Command\CommandBus;
use App\WebApi\Resources\Cart\Cart;
use App\WebApi\Resources\Cart\CartPresenter;
use App\WebApi\Resources\Cart\ProductsList;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CreateCartAction extends AbstractController
{
    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $cartId = Uuid::uuid4()->toString();

        $this->commandBus->dispatch(new CreateCartCommand($cartId));

        $cart = new Cart($cartId, new ProductsList());

        $presenter = new CartPresenter($cart);

        return new JsonResponse($presenter->present(), Response::HTTP_CREATED);
    }
}
