<?php
declare(strict_types=1);

namespace App\Tests;

use App\Common\Domain\DomainEvents;

abstract class UnitTestCase extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        DomainEvents::clear();
    }
}
