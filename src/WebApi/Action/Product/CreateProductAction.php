<?php
declare(strict_types=1);

namespace App\WebApi\Action\Product;

use App\WebApi\Resources\Product\Product;
use App\WebApi\Resources\Product\ProductPresenter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class CreateProductAction extends AbstractController
{
    public function __invoke(): JsonResponse
    {
        $product = new Product(1, 'GTA', 25600);

        $presenter = new ProductPresenter($product);
        return new JsonResponse($presenter->present(), Response::HTTP_CREATED);
    }
}
