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

final class Version20231111035942 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add several values in the `status` column of `distribution` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE distribution CHANGE status status ENUM(\'delivered\', \'distributed\', \'reassigned\', \'billing-pending\', \'billing-success\', \'billing-failure\', \'delivering\', \'delivery-success\', \'delivery-failure\', \'distributing\', \'distribution-success\', \'distribution-failure\', \'reassigning\', \'reassignment-success\', \'reassignment-failure\', \'sweeping\', \'sweep-success\', \'sweep-failure\');');
        $this->addSql('ALTER TABLE distribution_audit CHANGE status status ENUM(\'delivered\', \'distributed\', \'reassigned\', \'billing-pending\', \'billing-success\', \'billing-failure\', \'delivering\', \'delivery-success\', \'delivery-failure\', \'distributing\', \'distribution-success\', \'distribution-failure\', \'reassigning\', \'reassignment-success\', \'reassignment-failure\', \'sweeping\', \'sweep-success\', \'sweep-failure\');');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE distribution CHANGE status status ENUM(\'delivered\', \'distributed\', \'reassigned\');');
        $this->addSql('ALTER TABLE distribution_audit CHANGE status status VARCHAR(255) DEFAULT NULL;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
