<?php
declare(strict_types=1);

namespace App\Tests\Catalog\Unit;

use App\Common\Domain\DomainEvents;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        DomainEvents::clear();
    }
}
