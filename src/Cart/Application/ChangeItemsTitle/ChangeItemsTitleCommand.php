<?php
declare(strict_types=1);

namespace App\Cart\Application\ChangeItemsTitle;

use App\Common\Application\Command\Command;

final class ChangeItemsTitleCommand implements Command
{
    public function __construct(
        private int $externalId,
        private string $newTitle
    ) {
    }

    public function getExternalId(): int
    {
        return $this->externalId;
    }

    public function getNewTitle(): string
    {
        return $this->newTitle;
    }
}
