<?php
declare(strict_types=1);

namespace App\Tests\Cart\Integration;

use App\Common\Application\Command\CommandBus;
use App\Common\Application\Query\QueryBus;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class TestCase extends KernelTestCase
{
    protected CommandBus $commandBus;
    protected QueryBus $queryBus;
    protected EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        $this->commandBus = self::getContainer()->get(CommandBus::class);
        $this->queryBus = self::getContainer()->get(QueryBus::class);
        $this->entityManager = self::getContainer()->get(EntityManagerInterface::class);

    }

    protected function loadCarts(): void
    {
        $this->executeQueries('carts');
    }

    protected function getCartId(): string
    {
        return 'cf299192-e54f-4254-921c-87cf9d7cc770';
    }

    private function executeQueries(string $fileName): void
    {
        /** @var Connection $connection */
        $connection = self::getContainer()->get(Connection::class);

        $content = file_get_contents($this->getFixturesPath($fileName));

        foreach (array_filter(explode("\n", $content)) as $query) {
            $connection->executeQuery($query);
        }
    }

    private function getFixturesPath(string $fileName): string
    {
        return __DIR__ . '/../fixtures/' . $fileName . '.sql';
    }
}
