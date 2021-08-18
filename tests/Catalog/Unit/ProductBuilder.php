<?php
declare(strict_types=1);

namespace App\Tests\Catalog\Unit;

use App\Catalog\Domain\Product;
use App\Catalog\Domain\ProductId;
use Money\Money;

class ProductBuilder
{
    private ProductId $id;
    private string $title;
    private Money $price;

    public function __construct()
    {
        $this->id = new ProductId(1);
        $this->title = 'title';
        $this->price = Money::USD(123);
    }

    public static function create(): self
    {
        return new self();
    }

    public function withId(int $id): self
    {
        $this->id = new ProductId($id);

        return $this;
    }

    public function withTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function withPrice(int $price): self
    {
        $this->price = Money::USD($price);

        return $this;
    }

    public function build(): Product
    {
        return new Product(
            $this->id,
            $this->title,
            $this->price
        );
    }
}
