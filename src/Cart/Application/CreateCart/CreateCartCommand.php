<?php
declare(strict_types=1);

namespace App\Cart\Application\CreateCart;

use App\Common\Application\Command\Command;

final class CreateCartCommand implements Command
{
    public function __construct(private string $id)
    {
    }

    public function getId(): string
    {
        return $this->id;
    }
}
