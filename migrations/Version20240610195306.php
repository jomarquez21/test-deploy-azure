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

final class Version20240610195306 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Remove constraint UNIQUE to target_distribution_id field.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE distribution DROP INDEX UNIQ_A44837812CB83FD6, ADD INDEX IDX_A44837812CB83FD6 (target_distribution_id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE distribution DROP INDEX IDX_A44837812CB83FD6, ADD UNIQUE INDEX UNIQ_A44837812CB83FD6 (target_distribution_id);');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
