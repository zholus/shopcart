<?php
declare(strict_types=1);

namespace App\Catalog\Application\GetProductDetailsByTitle;

use App\Common\Application\Query\Query;

final class GetProductDetailsByTitleQuery implements Query
{
    public function __construct(private string $title)
    {
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
