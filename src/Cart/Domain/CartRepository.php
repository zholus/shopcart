<?php
declare(strict_types=1);

namespace App\Cart\Domain;

interface CartRepository
{
    public function save(Cart $cart): void;
    public function findById(CartId $cartId): Cart;
    public function update(Cart $cart): void;
}
