<?php
declare(strict_types=1);

namespace App\Catalog\Domain;

use Money\Money;

class Product
{
    public function __construct(
        private ProductId $id,
        private string $title,
        private Money $price
    ) {
    }

    public static function create(
        ProductId $productId,
        string $title,
        Money $money,
        ProductTitleUniquenessChecker $titleUniquenessChecker
    ): self {
        if (!$titleUniquenessChecker->isUnique($title)) {
            throw ProductWithTitleExistsException::create($title);
        }

        return new self(
            $productId,
            $title,
            $money
        );
    }

    public function changeTitle(string $title, ProductTitleUniquenessChecker $titleUniquenessChecker): void
    {
        if ($this->title === $title) {
            return;
        }

        if (!$titleUniquenessChecker->isUnique($title)) {
            throw ProductWithTitleExistsException::create($title);
        }

        $this->title = $title;
    }

    public function changePrice(Money $price): void
    {
        $this->price = clone $price;
    }
}
