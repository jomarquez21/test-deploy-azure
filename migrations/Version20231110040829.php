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

final class Version20231110040829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `invoice` and `invoice_item` tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, sales_center_id INT DEFAULT NULL, concessionary_id INT DEFAULT NULL, invoice_number INT NOT NULL, external_id VARCHAR(255) NOT NULL, signed_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_90651744657CAB3E (sales_center_id), UNIQUE INDEX UNIQ_9065174439BBA722 (concessionary_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE invoice_item (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, invoice_id INT NOT NULL, amount DOUBLE PRECISION NOT NULL, quantity INT NOT NULL, description VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_1DDE477B4584665A (product_id), INDEX IDX_1DDE477B2989F1FD (invoice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE invoice_item_taxes (invoice_item_id INT NOT NULL, tax_id INT NOT NULL, INDEX IDX_11F5CCB6E0B6648D (invoice_item_id), INDEX IDX_11F5CCB6B2A824D8 (tax_id), PRIMARY KEY(invoice_item_id, tax_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744657CAB3E FOREIGN KEY (sales_center_id) REFERENCES sales_center (id);');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_9065174439BBA722 FOREIGN KEY (concessionary_id) REFERENCES concessionary (id);');
        $this->addSql('ALTER TABLE invoice_item ADD CONSTRAINT FK_1DDE477B4584665A FOREIGN KEY (product_id) REFERENCES product (id);');
        $this->addSql('ALTER TABLE invoice_item ADD CONSTRAINT FK_1DDE477B2989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id);');
        $this->addSql('ALTER TABLE invoice_item_taxes ADD CONSTRAINT FK_11F5CCB6E0B6648D FOREIGN KEY (invoice_item_id) REFERENCES invoice_item (id);');
        $this->addSql('ALTER TABLE invoice_item_taxes ADD CONSTRAINT FK_11F5CCB6B2A824D8 FOREIGN KEY (tax_id) REFERENCES tax (id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_90651744657CAB3E;');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_9065174439BBA722;');
        $this->addSql('ALTER TABLE invoice_item DROP FOREIGN KEY FK_1DDE477B4584665A;');
        $this->addSql('ALTER TABLE invoice_item DROP FOREIGN KEY FK_1DDE477B2989F1FD;');
        $this->addSql('ALTER TABLE invoice_item_taxes DROP FOREIGN KEY FK_11F5CCB6E0B6648D;');
        $this->addSql('ALTER TABLE invoice_item_taxes DROP FOREIGN KEY FK_11F5CCB6B2A824D8;');
        $this->addSql('DROP TABLE invoice;');
        $this->addSql('DROP TABLE invoice_item;');
        $this->addSql('DROP TABLE invoice_item_taxes;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
