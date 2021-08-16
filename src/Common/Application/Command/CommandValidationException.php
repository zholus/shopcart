<?php
declare(strict_types=1);

namespace App\Common\Application\Command;

use RuntimeException;

final class CommandValidationException extends RuntimeException
{
    /**
     * @var string[]
     */
    private array $messages;

    /**
     * @param string[] $messages
     */
    public function __construct(array $messages, string $commandFQCN)
    {
        parent::__construct(sprintf(
            '%s: %s',
            $commandFQCN,
            implode("\n", $messages)
        ));

        $this->messages = $messages;
    }

    /**
     * @return string[]
     */
    public function getMessages(): array
    {
        return $this->messages;
    }
}
