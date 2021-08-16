<?php
declare(strict_types=1);

namespace App\Catalog\Application\ReadModel;

class PaginationData
{
    public function __construct(
        private int $totalItems,
        private int $perPage,
        private int $currentPage,
        private int $totalPages
    ) {
    }

    public function getTotalItems(): int
    {
        return $this->totalItems;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }
}
