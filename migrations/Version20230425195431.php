<?php

declare(strict_types=1);

/*
 * This file is part of Bimbo México | Módulo de Frío.
 *
 * (c) Bimbo México | Módulo de Frío <bimbocvhub@bimbo.com.mx>.
 *
 * This source file is subject to a proprietary license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230425195431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adds `product` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, internal_code VARCHAR(255) NOT NULL, bar_code VARCHAR(255) NOT NULL, large_name VARCHAR(255) NOT NULL, short_name VARCHAR(255) NOT NULL, key_sat VARCHAR(255) NOT NULL, unit_key VARCHAR(255) NOT NULL, shelf_life INT NOT NULL, return_limit INT NOT NULL, is_valid TINYINT(1) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_D34A04AD9B95A153 (internal_code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE product;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
