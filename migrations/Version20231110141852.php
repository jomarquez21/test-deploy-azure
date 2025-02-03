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

final class Version20231110141852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `operation_reference` column in `classification_group` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE `classification_group` SET `classification_group`.`operation_reference` = CONCAT(YEAR(`classification_group`.`created_at`), \'-\', MONTH(`classification_group`.`created_at`), \'-\', DAY(`classification_group`.`created_at`));');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('UPDATE `classification_group` SET `classification_group`.`operation_reference` = NULL;');
    }

    public function isTransactional(): bool
    {
        return true;
    }
}
