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

final class Version20231110041829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add column `region_id` in `sales_center` tabla.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sales_center ADD region_id VARCHAR(255) NOT NULL;');
        $this->addSql('ALTER TABLE sales_center_audit ADD region_id VARCHAR(255) DEFAULT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sales_center DROP region_id;');
        $this->addSql('ALTER TABLE sales_center_audit DROP region_id;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
