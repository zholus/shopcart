<?php
declare(strict_types=1);

namespace App\Catalog\Application\GetProductsPaginated;

use App\Common\Application\Query\Query;

final class GetProductsPaginatedQuery implements Query
{
    public function __construct(
        private int $page
    ) {
    }

    public function getPage(): int
    {
        return $this->page;
    }
}
