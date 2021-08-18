<?php
declare(strict_types=1);

namespace App\Catalog\Domain;

use App\Common\Domain\Aggregate;
use Money\Money;

class Product extends Aggregate
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

    public function changeTitle(string $newTitle, ProductTitleUniquenessChecker $titleUniquenessChecker): void
    {
        if ($this->title === $newTitle) {
            return;
        }

        if (!$titleUniquenessChecker->isUnique($newTitle)) {
            throw ProductWithTitleExistsException::create($newTitle);
        }

        $oldTitle = $this->title;

        $this->title = $newTitle;

        $this->publishDomainEvent(new TitleChanged(
            $this->id,
            $oldTitle,
            $newTitle
        ));
    }

    public function changePrice(Money $newPrice): void
    {
        if ($this->price->equals($newPrice)) {
            return;
        }

        $oldPrice = $this->price;

        $this->price = $newPrice;

        $this->publishDomainEvent(new PriceChanged(
            $this->id,
            $oldPrice,
            $newPrice
        ));
    }

    public function delete(): void
    {
        $this->publishDomainEvent(new ProductDeleted(
            $this->id,
            $this->title,
            $this->price
        ));
    }
}
