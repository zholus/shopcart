<?php
declare(strict_types=1);

namespace App\Cart\Application\GetCartDetailsById;

use App\Cart\Application\ReadModel\Cart;
use App\Cart\Application\ReadModel\CartReadModel;
use App\Common\Application\Query\QueryHandler;

final class GetCartDetailsByIdHandler implements QueryHandler
{
    public function __construct(private CartReadModel $cartReadModel)
    {
    }

    public function __invoke(GetCartDetailsByIdQuery $query): Cart
    {
        return $this->cartReadModel->findById($query->getId());
    }
}
