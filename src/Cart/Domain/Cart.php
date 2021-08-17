<?php
declare(strict_types=1);

namespace App\Cart\Domain;


class Cart
{
    /**
     * @param Item[] $items
     */
    public function __construct(
        private CartId $id,
        private array $items
    ) {
    }

    public static function create(CartId $id): self
    {
        return new self($id, []);
    }

    public function getSnapshot(): CartSnapshot
    {
        return new CartSnapshot(
            $this->id->getId()
        );
    }
}
