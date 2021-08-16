<?php
declare(strict_types=1);

namespace App\Catalog\Domain;

class ProductId
{
    public function __construct(private ?int $id)
    {
    }

    public static function fromInt(int $id): self
    {
        return new self($id);
    }

    public static function nullable(): self
    {
        return new self(null);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return (string)$this->id;
    }
}
