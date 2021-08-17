<?php
declare(strict_types=1);

namespace App\WebApi\Action\Product;

use App\Catalog\Application\DeleteProduct\DeleteProductCommand;
use App\Common\Application\Command\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class DeleteProductAction extends AbstractController
{
    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(int $productId): JsonResponse
    {
        $this->commandBus->dispatch(new DeleteProductCommand($productId));


        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
