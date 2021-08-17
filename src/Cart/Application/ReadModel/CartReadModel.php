<?php
declare(strict_types=1);

namespace App\Cart\Application\ReadModel;

interface CartReadModel
{
    public function findById(string $id): Cart;
}
