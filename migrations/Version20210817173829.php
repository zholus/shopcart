<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210817173829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            create table carts
            (
                id char(36) not null
                    primary key
            );
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('
            DROP TABLE carts
        ');
    }
}
