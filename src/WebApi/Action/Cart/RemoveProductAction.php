<?php
declare(strict_types=1);

namespace App\WebApi\Action\Cart;

use App\Cart\Application\RemoveItemFromCart\RemoveItemFromCartCommand;
use App\Common\Application\Command\CommandBus;
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
        $this->commandBus->dispatch(new RemoveItemFromCartCommand($cartId, $productId));

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
