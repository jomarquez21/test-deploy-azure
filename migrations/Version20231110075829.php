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

final class Version20231110075829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `currency` and `locale` columns of `sales_center` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sales_center ADD currency VARCHAR(255) DEFAULT \'MXN\' NOT NULL, ADD locale VARCHAR(255) DEFAULT \'es_MX\' NOT NULL;');
        $this->addSql('ALTER TABLE sales_center_audit ADD currency VARCHAR(255) DEFAULT \'MXN\', ADD locale VARCHAR(255) DEFAULT \'es_MX\';');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sales_center DROP currency, DROP locale;');
        $this->addSql('ALTER TABLE sales_center_audit DROP currency, DROP locale;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
