<?php
declare(strict_types=1);

namespace App\Catalog\Domain;

interface ProductTitleUniquenessChecker
{
    public function isUnique(string $title): bool;
}
