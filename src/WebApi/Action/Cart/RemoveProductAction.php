<?php
declare(strict_types=1);

namespace App\WebApi\Action\Cart;

use App\Cart\Application\RemoveItemFromCart\RemoveItemFromCartCommand;
use App\Common\Application\Command\CommandBus;
use App\Common\Application\Command\CommandValidationException;
use DomainException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class RemoveProductAction extends AbstractController
{
    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(string $cartId, int $productId, Request $request): JsonResponse
    {
        try {
            $this->commandBus->dispatch(new RemoveItemFromCartCommand($cartId, $productId));
        } catch (CommandValidationException $exception) {
            return new JsonResponse([
                'errors' => $exception->getMessages()
            ], Response::HTTP_BAD_REQUEST);
        } catch (DomainException $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage()
            ], Response::HTTP_CONFLICT);
        }

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
