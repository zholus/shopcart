<?php
declare(strict_types=1);

namespace App\Cart\Domain;

class CartSnapshot
{
    public function __construct(
        private string $id
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }
}
