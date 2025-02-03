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

final class Version20231109185354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update `internal_number` column in `sales_center` table to make it nullable and `external_number` column to make it non-nullable.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sales_center CHANGE internal_number internal_number VARCHAR(255) DEFAULT NULL, CHANGE external_number external_number VARCHAR(255) NOT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sales_center CHANGE external_number external_number VARCHAR(255) DEFAULT NULL, CHANGE internal_number internal_number VARCHAR(255) NOT NULL;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
