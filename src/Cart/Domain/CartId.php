<?php
declare(strict_types=1);

namespace App\Cart\Domain;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

class CartId
{
    private string $id;

    public function __construct(string $id)
    {
        if (!Uuid::isValid($id)) {
            throw new InvalidArgumentException(sprintf('Given uuid is not valid [%s]', $id));
        }

        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
