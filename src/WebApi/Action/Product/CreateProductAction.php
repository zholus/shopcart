<?php
declare(strict_types=1);

namespace App\WebApi\Action\Product;

use App\Catalog\Application\CreateProduct\CreateProductCommand;
use App\Common\Application\Command\CommandBus;
use App\Common\Application\Command\CommandValidationException;
use App\WebApi\Resources\Product\Product;
use App\WebApi\Resources\Product\ProductPresenter;
use DomainException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CreateProductAction extends AbstractController
{
    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $title = $request->get('title', '');
        $price = (int)$request->get('price', 0);

        try {
            $this->commandBus->dispatch(new CreateProductCommand($title, $price));
        } catch (CommandValidationException $exception) {
            return new JsonResponse([
                'errors' => $exception->getMessages()
            ], Response::HTTP_BAD_REQUEST);
        } catch (DomainException $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage()
            ], Response::HTTP_CONFLICT);
        }

        $product = new Product(1, $title, $price);

        $presenter = new ProductPresenter($product);
        return new JsonResponse($presenter->present(), Response::HTTP_CREATED);
    }
}
