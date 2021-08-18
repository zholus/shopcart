<?php

namespace App\DataFixtures;

use App\Catalog\Application\CreateProduct\CreateProductCommand;
use App\Common\Application\Command\CommandBus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function __construct(private CommandBus $commandBus)
    {
    }

    public function load(ObjectManager $manager)
    {
        $this->commandBus->dispatch(new CreateProductCommand('Fallout', 199));
        $this->commandBus->dispatch(new CreateProductCommand('Don’t Starve', 299));
        $this->commandBus->dispatch(new CreateProductCommand('Baldur’s Gate', 399));
        $this->commandBus->dispatch(new CreateProductCommand('Icewind Dale', 499));
        $this->commandBus->dispatch(new CreateProductCommand('Bloodborne', 599));
    }
}
