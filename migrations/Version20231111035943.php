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

final class Version20231111035943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update old values in the `status` column of `distribution` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE `distribution` SET `status` = "delivery-success" WHERE `status` = "delivered";');
        $this->addSql('UPDATE `distribution` SET `status` = "distribution-success" WHERE `status` = "distributed";');
        $this->addSql('UPDATE `distribution` SET `status` = "reassignment-success" WHERE `status` = "reassigned";');
        $this->addSql('UPDATE `distribution_audit` SET `status` = "delivery-success" WHERE `status` = "delivered";');
        $this->addSql('UPDATE `distribution_audit` SET `status` = "distribution-success" WHERE `status` = "distributed";');
        $this->addSql('UPDATE `distribution_audit` SET `status` = "reassignment-success" WHERE `status` = "reassigned";');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('UPDATE `distribution` SET `status` = "delivered" WHERE `status` = "delivery-success";');
        $this->addSql('UPDATE `distribution` SET `status` = "distributed" WHERE `status` = "distribution-success";');
        $this->addSql('UPDATE `distribution` SET `status` = "reassigned" WHERE `status` = "reassigned";');
        $this->addSql('UPDATE `distribution_audit` SET `status` = "delivered" WHERE `status` = "delivery-success";');
        $this->addSql('UPDATE `distribution_audit` SET `status` = "distributed" WHERE `status` = "distribution-success";');
        $this->addSql('UPDATE `distribution_audit` SET `status` = "reassigned" WHERE `status` = "reassigned";');
    }

    public function isTransactional(): bool
    {
        return true;
    }
}
