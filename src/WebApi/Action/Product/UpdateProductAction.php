<?php
declare(strict_types=1);

namespace App\WebApi\Action\Product;

use App\WebApi\Resources\Product\Product;
use App\WebApi\Resources\Product\ProductPresenter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class UpdateProductAction extends AbstractController
{
    public function __invoke(): Response
    {
        $product = new Product(1, 'GTA', 25600);

        $presenter = new ProductPresenter($product);

        return new JsonResponse($presenter->present());
    }
}
