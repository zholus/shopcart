<?php
declare(strict_types=1);

namespace App\Cart\Application\GetCartDetailsById;

use App\Common\Application\Query\Query;

final class GetCartDetailsByIdQuery implements Query
{
    public function __construct(private string $id)
    {
    }

    public function getId(): string
    {
        return $this->id;
    }
}
