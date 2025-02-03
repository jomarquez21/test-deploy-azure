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

final class Version20231228165338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `User::$hasAccessToAllSalesCenters` and `User::$salesCenters` properties.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE user_sales_centers (user_id INT NOT NULL, sales_center_id INT NOT NULL, INDEX IDX_C73A0A01A76ED395 (user_id), UNIQUE INDEX UNIQ_C73A0A01657CAB3E (sales_center_id), PRIMARY KEY(user_id, sales_center_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE user_sales_centers_audit (user_id INT NOT NULL, sales_center_id INT NOT NULL, rev INT NOT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_31951ec96597cf25b03ac52a865b3ad0_idx (rev), PRIMARY KEY(user_id, sales_center_id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE user_sales_centers ADD CONSTRAINT FK_C73A0A01A76ED395 FOREIGN KEY (user_id) REFERENCES user (id);');
        $this->addSql('ALTER TABLE user_sales_centers ADD CONSTRAINT FK_C73A0A01657CAB3E FOREIGN KEY (sales_center_id) REFERENCES sales_center (id) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE user ADD has_access_to_all_sales_centers TINYINT(1) DEFAULT 0 NOT NULL;');
        $this->addSql('ALTER TABLE user_audit ADD has_access_to_all_sales_centers TINYINT(1) DEFAULT 0;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user_sales_centers DROP FOREIGN KEY FK_C73A0A01A76ED395;');
        $this->addSql('ALTER TABLE user_sales_centers DROP FOREIGN KEY FK_C73A0A01657CAB3E;');
        $this->addSql('DROP TABLE journal_entry_audit;');
        $this->addSql('DROP TABLE user_sales_centers;');
        $this->addSql('DROP TABLE user_sales_centers_audit;');
        $this->addSql('ALTER TABLE user DROP has_access_to_all_sales_centers;');
        $this->addSql('ALTER TABLE user_audit DROP has_access_to_all_sales_centers;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
