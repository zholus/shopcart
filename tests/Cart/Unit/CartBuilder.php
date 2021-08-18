<?php
declare(strict_types=1);

namespace App\Tests\Cart\Unit;

use App\Cart\Domain\Cart;
use App\Cart\Domain\CartId;
use Ramsey\Uuid\Uuid;

class CartBuilder
{
    private CartId $id;
    private array $items;

    public function __construct()
    {
        $this->id = new CartId(Uuid::uuid4()->toString());
        $this->items = [];
    }

    public static function create(): self
    {
        return new self();
    }

    public function build(): Cart
    {
        return new Cart(
            $this->id,
            $this->items
        );
    }
}
