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

final class Version20230707210109 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add column `packaging_code` in table `product`.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product ADD packaging_code VARCHAR(255) NOT NULL;');
        $this->addSql('ALTER TABLE product_audit ADD packaging_code VARCHAR(255) DEFAULT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product DROP packaging_code;');
        $this->addSql('ALTER TABLE product_audit DROP packaging_code;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
