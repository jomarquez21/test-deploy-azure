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

final class Version20231031155316 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update `client.branch_chain` column to use "ENUM" definition.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE client CHANGE branch_chain branch_chain ENUM(\'Punto_Venta\', \'Cadena\') NOT NULL;');
        $this->addSql('ALTER TABLE client_audit CHANGE branch_chain branch_chain ENUM(\'Punto_Venta\', \'Cadena\') NOT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE client CHANGE branch_chain branch_chain VARCHAR(255) DEFAULT NULL;');
        $this->addSql('ALTER TABLE client_audit CHANGE branch_chain branch_chain VARCHAR(255) DEFAULT NULL;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
