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

final class Version20231121174754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update `operation_reference` column in `distribution` table with the last `operation_reference` value in `classification_group` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE distribution SET distribution.classification_group_id = (SELECT id FROM classification_group WHERE classification_group.operation_reference IS NOT NULL ORDER BY classification_group.operation_reference DESC LIMIT 1) WHERE distribution.classification_group_id IS NULL;');
        $this->addSql('UPDATE distribution JOIN classification_group ON (distribution.classification_group_id = classification_group.id) SET distribution.operation_reference = classification_group.operation_reference;');
    }

    public function down(Schema $schema): void
    {
    }

    public function isTransactional(): bool
    {
        return true;
    }
}
