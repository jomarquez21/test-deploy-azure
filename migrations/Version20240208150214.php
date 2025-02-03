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

final class Version20240208150214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Make `DevolutionSystem::$role` property not nullable.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE devolution_system CHANGE role role VARCHAR(255) NOT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE devolution_system CHANGE role role VARCHAR(255) DEFAULT NULL;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
