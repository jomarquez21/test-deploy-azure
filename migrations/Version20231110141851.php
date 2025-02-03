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

final class Version20231110141851 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `operation_reference` colum in `classification_group` tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE classification_group ADD operation_reference VARCHAR(255) DEFAULT NULL;');
        $this->addSql('ALTER TABLE classification_group_audit ADD operation_reference VARCHAR(255) DEFAULT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE classification_group DROP operation_reference;');
        $this->addSql('ALTER TABLE classification_group_audit DROP operation_reference;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
