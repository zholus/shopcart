<?php
declare(strict_types=1);

namespace App\Tests\Cart\Integration\CreateCart;

use App\Cart\Application\CreateCart\CreateCartCommand;
use App\Cart\Application\GetCartDetailsById\GetCartDetailsByIdQuery;
use App\Cart\Application\ReadModel\Cart;
use App\Tests\Cart\Integration\TestCase;
use Ramsey\Uuid\Uuid;

final class CreateCartTest extends TestCase
{
    public function testCreateCart(): void
    {
        $cartId = Uuid::uuid4()->toString();

        $this->commandBus->dispatch(new CreateCartCommand($cartId));

        /** @var Cart $cartReadModel */
        $cartReadModel = $this->queryBus->handle(new GetCartDetailsByIdQuery($cartId));

        $this->assertSame($cartId, $cartReadModel->getId());
    }
}
