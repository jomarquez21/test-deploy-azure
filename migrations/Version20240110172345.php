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

final class Version20240110172345 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `User::$azureId` property and remove uniqueness for `sales_center_id` to `user_sales_centers` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user ADD azure_id VARCHAR(255) DEFAULT NULL;');
        $this->addSql('ALTER TABLE user_audit ADD azure_id VARCHAR(255) DEFAULT NULL;');
        $this->addSql('ALTER TABLE user_sales_centers DROP INDEX UNIQ_C73A0A01657CAB3E, ADD INDEX IDX_C73A0A01657CAB3E (sales_center_id);');
        $this->addSql('ALTER TABLE user_sales_centers DROP FOREIGN KEY FK_C73A0A01657CAB3E;');
        $this->addSql('ALTER TABLE user_sales_centers ADD CONSTRAINT FK_C73A0A01657CAB3E FOREIGN KEY (sales_center_id) REFERENCES sales_center (id);');
        $this->addSql('ALTER TABLE role_group ADD is_editable TINYINT(1) DEFAULT 1 NOT NULL, ADD is_removable TINYINT(1) DEFAULT 1 NOT NULL;');
        $this->addSql('ALTER TABLE role_group_audit ADD is_editable TINYINT(1) DEFAULT 1, ADD is_removable TINYINT(1) DEFAULT 1;');
        $this->addSql('ALTER TABLE user ADD is_editable TINYINT(1) DEFAULT 1 NOT NULL, ADD is_removable TINYINT(1) DEFAULT 1 NOT NULL;');
        $this->addSql('ALTER TABLE user_audit ADD is_editable TINYINT(1) DEFAULT 1, ADD is_removable TINYINT(1) DEFAULT 1;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user DROP azure_id;');
        $this->addSql('ALTER TABLE user_audit DROP azure_id;');
        $this->addSql('ALTER TABLE user_sales_centers DROP INDEX IDX_C73A0A01657CAB3E, ADD UNIQUE INDEX UNIQ_C73A0A01657CAB3E (sales_center_id);');
        $this->addSql('ALTER TABLE user_sales_centers DROP FOREIGN KEY FK_C73A0A01657CAB3E;');
        $this->addSql('ALTER TABLE user_sales_centers ADD CONSTRAINT FK_C73A0A01657CAB3E FOREIGN KEY (sales_center_id) REFERENCES sales_center (id) ON UPDATE NO ACTION ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE role_group DROP is_editable, DROP is_removable;');
        $this->addSql('ALTER TABLE role_group_audit DROP is_editable, DROP is_removable;');
        $this->addSql('ALTER TABLE user DROP is_editable, DROP is_removable;');
        $this->addSql('ALTER TABLE user_audit DROP is_editable, DROP is_removable;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
