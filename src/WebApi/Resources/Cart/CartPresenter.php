<?php
declare(strict_types=1);

namespace App\WebApi\Resources\Cart;

class CartPresenter
{
    public function __construct(private Cart $cart)
    {
    }

    public function present(): array
    {
        return [
            'id' => $this->cart->getId(),
            'total_price' => $this->cart->getTotalPrice(),
            'products' => array_map(fn(Product $product) => [
                'id' => $product->getId(),
                'title' => $product->getTitle(),
                'count' => $product->getCount(),
                'single_unit_price' => $product->getSingleUnitPrice(),
                'total_price' => $product->getTotalPrice(),
            ], $this->cart->getProductsList()->getProducts())
        ];
    }
}
