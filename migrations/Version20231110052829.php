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

final class Version20231110052829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update associations and columns in the `invoice` and `invoice_item` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE distribution ADD invoice_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE distribution ADD CONSTRAINT FK_A44837812989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id);');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A44837812989F1FD ON distribution (invoice_id);');
        $this->addSql('ALTER TABLE distribution_audit ADD invoice_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE invoice DROP INDEX UNIQ_90651744657CAB3E, ADD INDEX IDX_90651744657CAB3E (sales_center_id);');
        $this->addSql('ALTER TABLE invoice DROP INDEX UNIQ_9065174439BBA722, ADD INDEX IDX_9065174439BBA722 (concessionary_id);');
        $this->addSql('ALTER TABLE invoice CHANGE sales_center_id sales_center_id INT NOT NULL, CHANGE concessionary_id concessionary_id INT NOT NULL;');
        $this->addSql('ALTER TABLE invoice CHANGE invoice_number invoice_number VARCHAR(255) NOT NULL;');
        $this->addSql('ALTER TABLE invoice CHANGE external_id external_id VARCHAR(255) DEFAULT NULL;');
        $this->addSql('ALTER TABLE invoice_item DROP INDEX UNIQ_1DDE477B4584665A, ADD INDEX IDX_1DDE477B4584665A (product_id);');
        $this->addSql('ALTER TABLE invoice_item CHANGE product_id product_id INT NOT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE distribution DROP FOREIGN KEY FK_A44837812989F1FD;');
        $this->addSql('DROP INDEX UNIQ_A44837812989F1FD ON distribution;');
        $this->addSql('ALTER TABLE distribution DROP invoice_id;');
        $this->addSql('ALTER TABLE distribution_audit DROP invoice_id;');
        $this->addSql('ALTER TABLE invoice DROP INDEX IDX_90651744657CAB3E, ADD UNIQUE INDEX UNIQ_90651744657CAB3E (sales_center_id);');
        $this->addSql('ALTER TABLE invoice DROP INDEX IDX_9065174439BBA722, ADD UNIQUE INDEX UNIQ_9065174439BBA722 (concessionary_id);');
        $this->addSql('ALTER TABLE invoice CHANGE sales_center_id sales_center_id INT DEFAULT NULL, CHANGE concessionary_id concessionary_id INT DEFAULT NULL, CHANGE invoice_number invoice_number INT NOT NULL, CHANGE external_id external_id VARCHAR(255) NOT NULL;');
        $this->addSql('ALTER TABLE invoice_item DROP INDEX IDX_1DDE477B4584665A, ADD UNIQUE INDEX UNIQ_1DDE477B4584665A (product_id);');
        $this->addSql('ALTER TABLE invoice_item CHANGE product_id product_id INT DEFAULT NULL;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
