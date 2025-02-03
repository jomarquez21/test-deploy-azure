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

final class Version20231110072829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `time_zone` column to `sales_center` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sales_center ADD time_zone VARCHAR(255) DEFAULT \'America/Mexico_City\' NOT NULL;');
        $this->addSql('ALTER TABLE sales_center_audit ADD time_zone VARCHAR(255) DEFAULT \'America/Mexico_City\';');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sales_center DROP time_zone;');
        $this->addSql('ALTER TABLE sales_center_audit DROP time_zone;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
