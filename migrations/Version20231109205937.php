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

final class Version20231109205937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `colony` column to `sales_center` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sales_center ADD colony VARCHAR(255) NOT NULL;');
        $this->addSql('ALTER TABLE sales_center_audit ADD colony VARCHAR(255) DEFAULT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sales_center DROP colony;');
        $this->addSql('ALTER TABLE sales_center_audit DROP colony;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
