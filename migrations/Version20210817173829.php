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

        $this->addSql('
            create table carts_items
            (
                id          char(36)     not null
                    primary key,
                cart_id     char(36)     not null,
                external_id int          not null,
                title       varchar(255) not null,
                price       int          not null,
                constraint carts_items_carts_id_fk
                    foreign key (cart_id) references carts (id)
                        on delete cascade
            );
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('
            DROP TABLE carts_items
        ');
        $this->addSql('
            DROP TABLE carts
        ');
    }
}
