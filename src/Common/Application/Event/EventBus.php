<?php
declare(strict_types=1);

namespace App\Common\Application\Event;

interface EventBus
{
    public function dispatch(object $event): void;
}
