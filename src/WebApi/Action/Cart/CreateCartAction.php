<?php
declare(strict_types=1);

namespace App\WebApi\Action\Cart;

use App\Cart\Application\CreateCart\CreateCartCommand;
use App\Common\Application\Command\CommandBus;
use App\Common\Application\Command\CommandValidationException;
use App\WebApi\Resources\Cart\Cart;
use App\WebApi\Resources\Cart\CartPresenter;
use App\WebApi\Resources\Cart\ProductsList;
use DomainException;
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

        try {
            $this->commandBus->dispatch(new CreateCartCommand($cartId));
        } catch (CommandValidationException $exception) {
            return new JsonResponse([
                'errors' => $exception->getMessages()
            ], Response::HTTP_BAD_REQUEST);
        } catch (DomainException $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage()
            ], Response::HTTP_CONFLICT);
        }

        $cart = new Cart($cartId, new ProductsList());

        $presenter = new CartPresenter($cart);

        return new JsonResponse($presenter->present(), Response::HTTP_CREATED);
    }
}
