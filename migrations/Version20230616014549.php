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

final class Version20230616014549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `revisions`, `country_audit`, `citizen_mx_audit`, `media_gallery_audit` and `country_audit` tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE revisions (id INT AUTO_INCREMENT NOT NULL, timestamp DATETIME NOT NULL, username VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE country_audit (id INT NOT NULL, rev INT NOT NULL, name VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', revtype VARCHAR(4) NOT NULL, INDEX rev_922a2e2fde8c24f7943de9485a005b9f_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE country_audit ADD iso3166Alpha2 VARCHAR(255) DEFAULT NULL;');
        $this->addSql('ALTER TABLE country_audit ADD CONSTRAINT rev_922a2e2fde8c24f7943de9485a005b9f_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('CREATE TABLE citizen_mx_audit (id INT NOT NULL, rev INT NOT NULL, state_id INT DEFAULT NULL, town_id INT DEFAULT NULL, fullname VARCHAR(255) DEFAULT NULL, birthdate DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', gender VARCHAR(255) DEFAULT NULL, external_number VARCHAR(255) DEFAULT NULL, internal_number VARCHAR(255) DEFAULT NULL, colony VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(255) DEFAULT NULL, voter_key VARCHAR(255) DEFAULT NULL, population_id VARCHAR(255) DEFAULT NULL, tax_register VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', revtype VARCHAR(4) NOT NULL, INDEX rev_1b92274a30d5d7cbddb2bcd9f10d007e_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE media_gallery_audit (id INT NOT NULL, rev INT NOT NULL, name VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, enabled TINYINT(1) DEFAULT NULL, provider_name VARCHAR(255) DEFAULT NULL, provider_status INT DEFAULT NULL, provider_reference VARCHAR(255) DEFAULT NULL, provider_metadata JSON DEFAULT NULL, width INT DEFAULT NULL, height INT DEFAULT NULL, length NUMERIC(10, 0) DEFAULT NULL, content_type VARCHAR(255) DEFAULT NULL, content_size INT DEFAULT NULL, copyright VARCHAR(255) DEFAULT NULL, author_name VARCHAR(255) DEFAULT NULL, context VARCHAR(64) DEFAULT NULL, cdn_is_flushable TINYINT(1) DEFAULT NULL, cdn_flush_identifier VARCHAR(64) DEFAULT NULL, cdn_flush_at DATETIME DEFAULT NULL, cdn_status INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_f3eeaeede18ebddb3ac09d1b915342cd_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE media_gallery_item_audit (id INT NOT NULL, rev INT NOT NULL, gallery_id INT DEFAULT NULL, media_id INT DEFAULT NULL, position INT DEFAULT NULL, enabled TINYINT(1) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_6fcf3dbd35eea37eac797743c4b3a30b_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE client_audit (id INT NOT NULL, rev INT NOT NULL, town_id INT DEFAULT NULL, county_id INT DEFAULT NULL, party_number VARCHAR(255) DEFAULT NULL, source_system VARCHAR(255) DEFAULT NULL, source_system_reference_value VARCHAR(255) DEFAULT NULL, profile_id VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, parent_account_party_id VARCHAR(255) DEFAULT NULL, parent_account_party_number VARCHAR(255) DEFAULT NULL, parent_account_name VARCHAR(255) DEFAULT NULL, taxpayer_id_number VARCHAR(255) DEFAULT NULL, business_name VARCHAR(255) DEFAULT NULL, tax_rate VARCHAR(255) DEFAULT NULL, branch_chain VARCHAR(255) DEFAULT NULL, taxpayer_type VARCHAR(255) DEFAULT NULL, cfdi_use VARCHAR(255) DEFAULT NULL, cfdi_credit_note_use VARCHAR(255) DEFAULT NULL, address_principal VARCHAR(255) DEFAULT NULL, address_secondary VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(255) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, address_type VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', revtype VARCHAR(4) NOT NULL, INDEX rev_0dbe2e44a6a7c2362b393ea5a3069e0e_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE state_audit (id INT NOT NULL, rev INT NOT NULL, country_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', revtype VARCHAR(4) NOT NULL, INDEX rev_8749e290de180467e24131f25c1f21a6_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE media_audit (id INT NOT NULL, rev INT NOT NULL, name VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, enabled TINYINT(1) DEFAULT NULL, provider_name VARCHAR(255) DEFAULT NULL, provider_status INT DEFAULT NULL, provider_reference VARCHAR(255) DEFAULT NULL, provider_metadata JSON DEFAULT NULL, width INT DEFAULT NULL, height INT DEFAULT NULL, length NUMERIC(10, 0) DEFAULT NULL, content_type VARCHAR(255) DEFAULT NULL, content_size INT DEFAULT NULL, copyright VARCHAR(255) DEFAULT NULL, author_name VARCHAR(255) DEFAULT NULL, context VARCHAR(64) DEFAULT NULL, cdn_is_flushable TINYINT(1) DEFAULT NULL, cdn_flush_identifier VARCHAR(64) DEFAULT NULL, cdn_flush_at DATETIME DEFAULT NULL, cdn_status INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_05e5435a629dc17f25bb0ec61460bff6_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE concessionary_audit (id INT NOT NULL, rev INT NOT NULL, citizen_mx_id INT DEFAULT NULL, client_id INT DEFAULT NULL, sales_center_id INT DEFAULT NULL, bank_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, is_uncollectible TINYINT(1) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, operation_date DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', bank_reference VARCHAR(255) DEFAULT NULL, agreement VARCHAR(255) DEFAULT NULL, tax_document VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', revtype VARCHAR(4) NOT NULL, INDEX rev_84158c5a9d912ec020b8e4bd18c1188f_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE user_audit (id INT NOT NULL, rev INT NOT NULL, email VARCHAR(180) DEFAULT NULL, roles JSON DEFAULT NULL, locale VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', revtype VARCHAR(4) NOT NULL, INDEX rev_e06395edc291d0719bee26fd39a32e8a_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE product_audit (id INT NOT NULL, rev INT NOT NULL, internal_code VARCHAR(255) DEFAULT NULL, bar_code VARCHAR(255) DEFAULT NULL, large_name VARCHAR(255) DEFAULT NULL, short_name VARCHAR(255) DEFAULT NULL, key_sat VARCHAR(255) DEFAULT NULL, unit_key VARCHAR(255) DEFAULT NULL, shelf_life INT DEFAULT NULL, return_limit INT DEFAULT NULL, is_valid TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', revtype VARCHAR(4) NOT NULL, INDEX rev_e6e41b81419a01db7854bd453c13dc6d_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE bank_audit (id INT NOT NULL, rev INT NOT NULL, country_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', revtype VARCHAR(4) NOT NULL, INDEX rev_8b476ac2d911b30d9723720bc77d70f2_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE town_audit (id INT NOT NULL, rev INT NOT NULL, state_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', revtype VARCHAR(4) NOT NULL, INDEX rev_72661e479ae07396c63c0cdfc3146739_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE sales_center_audit (id INT NOT NULL, rev INT NOT NULL, organization_id INT DEFAULT NULL, state_id INT DEFAULT NULL, town_id INT DEFAULT NULL, sales_center_base INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(255) DEFAULT NULL, neighborhood_code VARCHAR(255) DEFAULT NULL, neighborhood_description VARCHAR(255) DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, internal_number VARCHAR(255) DEFAULT NULL, external_number VARCHAR(255) DEFAULT NULL, is_recovers TINYINT(1) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', revtype VARCHAR(4) NOT NULL, INDEX rev_59d40bed189bb6c7c3d02fe76d3c08d2_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE organization_audit (id INT NOT NULL, rev INT NOT NULL, country_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', revtype VARCHAR(4) NOT NULL, INDEX rev_c50e732e5f1b2c67dbc712e20c7dcfd8_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE citizen_mx_audit ADD CONSTRAINT rev_1b92274a30d5d7cbddb2bcd9f10d007e_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('ALTER TABLE media_gallery_audit ADD CONSTRAINT rev_f3eeaeede18ebddb3ac09d1b915342cd_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('ALTER TABLE media_gallery_item_audit ADD CONSTRAINT rev_6fcf3dbd35eea37eac797743c4b3a30b_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('ALTER TABLE client_audit ADD CONSTRAINT rev_0dbe2e44a6a7c2362b393ea5a3069e0e_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('ALTER TABLE state_audit ADD CONSTRAINT rev_8749e290de180467e24131f25c1f21a6_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('ALTER TABLE media_audit ADD CONSTRAINT rev_05e5435a629dc17f25bb0ec61460bff6_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('ALTER TABLE concessionary_audit ADD CONSTRAINT rev_84158c5a9d912ec020b8e4bd18c1188f_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('ALTER TABLE user_audit ADD CONSTRAINT rev_e06395edc291d0719bee26fd39a32e8a_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('ALTER TABLE product_audit ADD CONSTRAINT rev_e6e41b81419a01db7854bd453c13dc6d_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('ALTER TABLE bank_audit ADD CONSTRAINT rev_8b476ac2d911b30d9723720bc77d70f2_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('ALTER TABLE town_audit ADD CONSTRAINT rev_72661e479ae07396c63c0cdfc3146739_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('ALTER TABLE sales_center_audit ADD CONSTRAINT rev_59d40bed189bb6c7c3d02fe76d3c08d2_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('ALTER TABLE organization_audit ADD CONSTRAINT rev_c50e732e5f1b2c67dbc712e20c7dcfd8_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('CREATE TABLE products_taxes_audit (tax_id INT NOT NULL, product_id INT NOT NULL, rev INT NOT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_7e03a4c5696c1a796760c6a7933f42fd_idx (rev), PRIMARY KEY(tax_id, product_id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE product_audit ADD organization_id INT DEFAULT NULL, ADD brand_id INT DEFAULT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE revisions;');
        $this->addSql('DROP TABLE country_audit;');
        $this->addSql('ALTER TABLE country_audit DROP COLUMN iso3166Alpha2;');
        $this->addSql('ALTER TABLE country_audit DROP CONSTRAINT rev_922a2e2fde8c24f7943de9485a005b9f_fk;');
        $this->addSql('ALTER TABLE citizen_mx_audit DROP CONSTRAINT rev_1b92274a30d5d7cbddb2bcd9f10d007e_fk;');
        $this->addSql('ALTER TABLE media_gallery_audit DROP CONSTRAINT rev_f3eeaeede18ebddb3ac09d1b915342cd_fk;');
        $this->addSql('ALTER TABLE media_gallery_item_audit DROP CONSTRAINT rev_6fcf3dbd35eea37eac797743c4b3a30b_fk;');
        $this->addSql('ALTER TABLE client_audit DROP CONSTRAINT rev_0dbe2e44a6a7c2362b393ea5a3069e0e_fk;');
        $this->addSql('ALTER TABLE state_audit DROP CONSTRAINT rev_8749e290de180467e24131f25c1f21a6_fk;');
        $this->addSql('ALTER TABLE media_audit DROP CONSTRAINT rev_05e5435a629dc17f25bb0ec61460bff6_fk;');
        $this->addSql('ALTER TABLE concessionary_audit DROP CONSTRAINT rev_84158c5a9d912ec020b8e4bd18c1188f_fk;');
        $this->addSql('ALTER TABLE user_audit DROP CONSTRAINT rev_e06395edc291d0719bee26fd39a32e8a_fk;');
        $this->addSql('ALTER TABLE product_audit DROP CONSTRAINT rev_e6e41b81419a01db7854bd453c13dc6d_fk;');
        $this->addSql('ALTER TABLE bank_audit DROP CONSTRAINT rev_8b476ac2d911b30d9723720bc77d70f2_fk;');
        $this->addSql('ALTER TABLE town_audit DROP CONSTRAINT rev_72661e479ae07396c63c0cdfc3146739_fk;');
        $this->addSql('ALTER TABLE sales_center_audit DROP CONSTRAINT rev_59d40bed189bb6c7c3d02fe76d3c08d2_fk;');
        $this->addSql('ALTER TABLE organization_audit DROP CONSTRAINT rev_c50e732e5f1b2c67dbc712e20c7dcfd8_fk;');
        $this->addSql('DROP TABLE citizen_mx_audit;');
        $this->addSql('DROP TABLE media_gallery_audit;');
        $this->addSql('DROP TABLE media_gallery_item_audit;');
        $this->addSql('DROP TABLE state_audit;');
        $this->addSql('DROP TABLE media_audit;');
        $this->addSql('DROP TABLE concessionary_audit;');
        $this->addSql('DROP TABLE user_audit;');
        $this->addSql('DROP TABLE product_audit;');
        $this->addSql('DROP TABLE bank_audit;');
        $this->addSql('DROP TABLE town_audit;');
        $this->addSql('DROP TABLE sales_center_audit;');
        $this->addSql('DROP TABLE organization_audit;');
        $this->addSql('DROP TABLE products_taxes_audit;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
