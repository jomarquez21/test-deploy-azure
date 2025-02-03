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

final class Version20231121174438 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `classification_group_id` and `operation_reference` columns in `distribution` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE `distribution` SET `classification_group_id` = (SELECT `classification_group`.`id` FROM `classification_group` ORDER BY `classification_group`.`created_at` ASC LIMIT 1);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('UPDATE `distribution` SET `classification_group_id` = NULL;');
    }

    public function isTransactional(): bool
    {
        return true;
    }
}
