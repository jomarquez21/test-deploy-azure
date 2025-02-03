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

final class Version20230501153148 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adds `client` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, town_id INT NOT NULL, county_id INT NOT NULL, party_number VARCHAR(255) NOT NULL, source_system VARCHAR(255) DEFAULT NULL, source_system_reference_value VARCHAR(255) DEFAULT NULL, profile_id VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, parent_account_party_id VARCHAR(255) DEFAULT NULL, parent_account_party_number VARCHAR(255) DEFAULT NULL, parent_account_name VARCHAR(255) DEFAULT NULL, taxpayer_id_number VARCHAR(255) DEFAULT NULL, business_name VARCHAR(255) DEFAULT NULL, tax_rate VARCHAR(255) DEFAULT NULL, branch_chain VARCHAR(255) DEFAULT NULL, taxpayer_type VARCHAR(255) DEFAULT NULL, cfdi_use VARCHAR(255) DEFAULT NULL, cfdi_credit_note_use VARCHAR(255) DEFAULT NULL, address_principal VARCHAR(255) DEFAULT NULL, address_secondary VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(255) DEFAULT NULL, is_active TINYINT(1) NOT NULL, address_type VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_C744045575E23604 (town_id), INDEX IDX_C744045585E73F45 (county_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045585E73F45 FOREIGN KEY (county_id) REFERENCES country (id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE client;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
