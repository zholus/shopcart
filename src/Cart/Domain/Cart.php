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

    public function addItem(ItemId $itemId, int $externalId, string $title, int $price): void
    {
        if (!$this->canAddItem($externalId)) {
            throw CannotAddMoreItemsToCartException::withExternalId($externalId);
        }

        $this->items[] = new Item(
            $itemId,
            $externalId,
            $title,
            $price
        );
    }

    public function getSnapshot(): CartSnapshot
    {
        return new CartSnapshot(
            $this->id->getId(),
            array_map(fn(Item $item) => $item->getSnapshot(), $this->items)
        );
    }

    private function canAddItem(int $externalId): bool
    {
        $array = array_filter($this->items, fn(Item $item) => $item->isExternalItem($externalId));

        return count($array) < 3;
    }

    public function remoteItemByExternalId(int $externalId): void
    {
        foreach ($this->items as $key => $item) {
            if ($item->isExternalItem($externalId)) {
                unset($this->items[$key]);
                break;
            }
        }

        $this->items = array_values($this->items);
    }
}
