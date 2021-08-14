<?php
declare(strict_types=1);

namespace App\WebApi\Action\Product;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class DeleteProductAction extends AbstractController
{
    public function __invoke(): Response
    {
        return new Response(__CLASS__);
    }
}
