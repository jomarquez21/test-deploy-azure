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

final class Version20231212131024 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `inventory_journal_entry`, `invoice_journal_entry`, `journal_entry`, `promissory_note_journal_entry` tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE inventory_journal_entry (id INT NOT NULL, transaction_number VARCHAR(255) NOT NULL, transaction_identifier VARCHAR(255) NOT NULL, transaction_type ENUM(\'delivery\', \'devolution\', \'sweep\'), transaction_hour VARCHAR(255) NOT NULL, transaction_affectation ENUM(\'delivery\', \'devolution\', \'sweep\'), product_internal_code VARCHAR(255) NOT NULL, inventory_type ENUM(\'delivery\', \'devolution\', \'sweep\'), quantity VARCHAR(255) NOT NULL, deficiency VARCHAR(255) NOT NULL, surplus VARCHAR(255) NOT NULL, rejection VARCHAR(255) NOT NULL, product_quota VARCHAR(255) NOT NULL, product_base_price VARCHAR(255) NOT NULL, product_amount VARCHAR(255) NOT NULL, product_cold_amount VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE invoice_journal_entry (id INT NOT NULL, lines_number INT NOT NULL, invoice_folio VARCHAR(255) NOT NULL, signed_at_reference VARCHAR(255) NOT NULL, credit_days VARCHAR(255) NOT NULL, product_internal_code VARCHAR(255) NOT NULL, product_sold_quantity VARCHAR(255) NOT NULL, product_sold_price VARCHAR(255) NOT NULL, product_sold_cost VARCHAR(255) NOT NULL, product_sold_price_difference VARCHAR(255) NOT NULL, tax_amount VARCHAR(255) NOT NULL, discount_amount VARCHAR(255) NOT NULL, promotion_Amount VARCHAR(255) NOT NULL, confidential_discount_amount VARCHAR(255) NOT NULL, product_sold_amount VARCHAR(255) NOT NULL, product_description VARCHAR(255) NOT NULL, product_category VARCHAR(255) NOT NULL, client_party_number VARCHAR(255) NOT NULL, client_name VARCHAR(255) NOT NULL, tax_code VARCHAR(255) NOT NULL, tax_percentage VARCHAR(255) NOT NULL, payment_type VARCHAR(255) NOT NULL, invoice_uuid VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE journal_entry (id INT AUTO_INCREMENT NOT NULL, operation_date_reference VARCHAR(255) NOT NULL, sales_center_code VARCHAR(255) NOT NULL, source_system VARCHAR(255) NOT NULL, country_code VARCHAR(255) NOT NULL, organization_legal_code VARCHAR(255) NOT NULL, route_identifier VARCHAR(255) NOT NULL, layout_version VARCHAR(255) NOT NULL, cost_center_code VARCHAR(255) NOT NULL, sent_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', status ENUM(\'process-failure\', \'processing\', \'process-success\', \'unprocessed\'), type ENUM(\'inventory-journal-entry\', \'invoice-journal-entry\', \'payment-registry-journal-entry\'), created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', discr VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE payment_registry_journal_entry (id INT NOT NULL, lines_number INT NOT NULL, payment_registry_type VARCHAR(255) NOT NULL, concessionary_bank_reference VARCHAR(255) NOT NULL, payment_registry_bank_transaction_number VARCHAR(255) NOT NULL, promissory_note_amount VARCHAR(255) NOT NULL, payment_registry_amount VARCHAR(255) NOT NULL, payment_registry_amount_difference VARCHAR(255) NOT NULL, promissory_note_created_at_reference VARCHAR(255) NOT NULL, promissory_note_number VARCHAR(255) NOT NULL, client_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE inventory_journal_entry ADD CONSTRAINT FK_ABF76DAEBF396750 FOREIGN KEY (id) REFERENCES journal_entry (id) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE invoice_journal_entry ADD CONSTRAINT FK_9F2DDC50BF396750 FOREIGN KEY (id) REFERENCES journal_entry (id) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE payment_registry_journal_entry ADD CONSTRAINT FK_59F5803ABF396750 FOREIGN KEY (id) REFERENCES journal_entry (id) ON DELETE CASCADE;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE inventory_journal_entry DROP FOREIGN KEY FK_ABF76DAEBF396750;');
        $this->addSql('ALTER TABLE invoice_journal_entry DROP FOREIGN KEY FK_9F2DDC50BF396750;');
        $this->addSql('ALTER TABLE payment_registry_journal_entry DROP FOREIGN KEY FK_59F5803ABF396750;');
        $this->addSql('DROP TABLE inventory_journal_entry;');
        $this->addSql('DROP TABLE invoice_journal_entry;');
        $this->addSql('DROP TABLE journal_entry;');
        $this->addSql('DROP TABLE payment_registry_journal_entry;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
