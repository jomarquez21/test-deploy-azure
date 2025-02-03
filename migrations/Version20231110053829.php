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

final class Version20231110053829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `status` column to `classification_group` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE classification_group ADD status ENUM(\'classifying\', \'classification-success\', \'classification-failure\', \'distributing\', \'distribution-success\', \'distribution-failure\', \'delivering\', \'delivery-success\', \'delivery-failure\', \'sweeping\', \'sweep-success\', \'sweep-failure\');');
        $this->addSql('ALTER TABLE classification_group_audit ADD status ENUM(\'classifying\', \'classification-success\', \'classification-failure\', \'distributing\', \'distribution-success\', \'distribution-failure\', \'delivering\', \'delivery-success\', \'delivery-failure\', \'sweeping\', \'sweep-success\', \'sweep-failure\');');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE classification_group DROP status;');
        $this->addSql('ALTER TABLE classification_group_audit DROP status;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
