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

final class Version20231110033829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `interfactura_fixed_parameter` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE interfactura_fixed_parameter (id INT AUTO_INCREMENT NOT NULL, property_path VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE interfactura_fixed_parameter;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
