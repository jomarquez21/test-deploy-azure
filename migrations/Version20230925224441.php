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

final class Version20230925224441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update `classification_group` table to add `end_of_cycle_at` column.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE classification_group ADD end_of_cycle_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\';');
        $this->addSql('ALTER TABLE classification_group_audit ADD end_of_cycle_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\';');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE classification_group DROP end_of_cycle_at;');
        $this->addSql('ALTER TABLE classification_group_audit DROP end_of_cycle_at;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
