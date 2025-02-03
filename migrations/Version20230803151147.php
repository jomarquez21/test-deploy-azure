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

final class Version20230803151147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update `citizen` table to add `street` column.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE citizen ADD street VARCHAR(255) DEFAULT NULL;');
        $this->addSql('ALTER TABLE citizen_audit ADD street VARCHAR(255) DEFAULT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE citizen DROP street;');
        $this->addSql('ALTER TABLE citizen_audit DROP street;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
