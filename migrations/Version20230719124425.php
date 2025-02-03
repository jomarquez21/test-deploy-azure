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

final class Version20230719124425 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `citizen` and `citizen_audit` tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE concessionary DROP FOREIGN KEY FK_A5F7D4CDE741E5E3;');
        $this->addSql('CREATE TABLE citizen (id INT AUTO_INCREMENT NOT NULL, state_id INT NOT NULL, town_id INT NOT NULL, municipality_id INT NOT NULL, country_id INT NOT NULL, fullname VARCHAR(255) NOT NULL, birthdate DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', gender VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', type VARCHAR(255) NOT NULL, external_number VARCHAR(255) DEFAULT NULL, internal_number VARCHAR(255) DEFAULT NULL, colony VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(255) DEFAULT NULL, voter_key VARCHAR(255) DEFAULT NULL, population_id VARCHAR(255) DEFAULT NULL, tax_register VARCHAR(255) DEFAULT NULL, INDEX IDX_A95317295D83CC1 (state_id), INDEX IDX_A953172975E23604 (town_id), INDEX IDX_A9531729AE6F181C (municipality_id), INDEX IDX_A9531729F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE citizen_audit (id INT NOT NULL, rev INT NOT NULL, state_id INT DEFAULT NULL, town_id INT DEFAULT NULL, municipality_id INT DEFAULT NULL, country_id INT DEFAULT NULL, fullname VARCHAR(255) DEFAULT NULL, birthdate DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', gender VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', type VARCHAR(255) DEFAULT NULL, external_number VARCHAR(255) DEFAULT NULL, internal_number VARCHAR(255) DEFAULT NULL, colony VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(255) DEFAULT NULL, voter_key VARCHAR(255) DEFAULT NULL, population_id VARCHAR(255) DEFAULT NULL, tax_register VARCHAR(255) DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_5d222f827e5bf59801321a4d547c74c5_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE citizen ADD CONSTRAINT FK_A95317295D83CC1 FOREIGN KEY (state_id) REFERENCES state (id);');
        $this->addSql('ALTER TABLE citizen ADD CONSTRAINT FK_A953172975E23604 FOREIGN KEY (town_id) REFERENCES town (id);');
        $this->addSql('ALTER TABLE citizen ADD CONSTRAINT FK_A9531729AE6F181C FOREIGN KEY (municipality_id) REFERENCES municipality (id);');
        $this->addSql('ALTER TABLE citizen ADD CONSTRAINT FK_A9531729F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id);');
        $this->addSql('ALTER TABLE citizen_audit ADD CONSTRAINT rev_5d222f827e5bf59801321a4d547c74c5_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('ALTER TABLE citizen_mx DROP FOREIGN KEY FK_D651A565AE6F181C;');
        $this->addSql('ALTER TABLE citizen_mx DROP FOREIGN KEY FK_D651A5655D83CC1;');
        $this->addSql('ALTER TABLE citizen_mx DROP FOREIGN KEY FK_D651A565F92F3E70;');
        $this->addSql('ALTER TABLE citizen_mx DROP FOREIGN KEY FK_D651A56575E23604;');
        $this->addSql('ALTER TABLE citizen_mx_audit DROP FOREIGN KEY rev_1b92274a30d5d7cbddb2bcd9f10d007e_fk;');
        $this->addSql('DROP TABLE citizen_mx;');
        $this->addSql('DROP TABLE citizen_mx_audit;');
        $this->addSql('DROP INDEX UNIQ_A5F7D4CDE741E5E3 ON concessionary;');
        $this->addSql('ALTER TABLE concessionary CHANGE citizen_mx_id citizen_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE concessionary ADD CONSTRAINT FK_A5F7D4CDA63C3C2E FOREIGN KEY (citizen_id) REFERENCES citizen (id);');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A5F7D4CDA63C3C2E ON concessionary (citizen_id);');
        $this->addSql('ALTER TABLE concessionary_audit CHANGE citizen_mx_id citizen_id INT DEFAULT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE concessionary DROP FOREIGN KEY FK_A5F7D4CDA63C3C2E;');
        $this->addSql('CREATE TABLE citizen_mx (id INT AUTO_INCREMENT NOT NULL, state_id INT NOT NULL, town_id INT NOT NULL, municipality_id INT NOT NULL, country_id INT NOT NULL, fullname VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, birthdate DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', gender VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, external_number VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, internal_number VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, colony VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, zip_code VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, voter_key VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, population_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, tax_register VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_D651A5655D83CC1 (state_id), INDEX IDX_D651A565AE6F181C (municipality_id), INDEX IDX_D651A56575E23604 (town_id), INDEX IDX_D651A565F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\';');
        $this->addSql('CREATE TABLE citizen_mx_audit (id INT NOT NULL, rev INT NOT NULL, state_id INT DEFAULT NULL, town_id INT DEFAULT NULL, fullname VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, birthdate DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', gender VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, external_number VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, internal_number VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, colony VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, zip_code VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, voter_key VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, population_id VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, tax_register VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', revtype VARCHAR(4) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, municipality_id INT DEFAULT NULL, country_id INT DEFAULT NULL, INDEX rev_1b92274a30d5d7cbddb2bcd9f10d007e_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\';');
        $this->addSql('ALTER TABLE citizen_mx ADD CONSTRAINT FK_D651A565AE6F181C FOREIGN KEY (municipality_id) REFERENCES municipality (id);');
        $this->addSql('ALTER TABLE citizen_mx ADD CONSTRAINT FK_D651A5655D83CC1 FOREIGN KEY (state_id) REFERENCES state (id);');
        $this->addSql('ALTER TABLE citizen_mx ADD CONSTRAINT FK_D651A565F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id);');
        $this->addSql('ALTER TABLE citizen_mx ADD CONSTRAINT FK_D651A56575E23604 FOREIGN KEY (town_id) REFERENCES town (id);');
        $this->addSql('ALTER TABLE citizen_mx_audit ADD CONSTRAINT rev_1b92274a30d5d7cbddb2bcd9f10d007e_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('ALTER TABLE citizen DROP FOREIGN KEY FK_A95317295D83CC1;');
        $this->addSql('ALTER TABLE citizen DROP FOREIGN KEY FK_A953172975E23604;');
        $this->addSql('ALTER TABLE citizen DROP FOREIGN KEY FK_A9531729AE6F181C;');
        $this->addSql('ALTER TABLE citizen DROP FOREIGN KEY FK_A9531729F92F3E70;');
        $this->addSql('ALTER TABLE citizen_audit DROP FOREIGN KEY rev_5d222f827e5bf59801321a4d547c74c5_fk;');
        $this->addSql('DROP TABLE citizen;');
        $this->addSql('DROP TABLE citizen_audit;');
        $this->addSql('DROP INDEX UNIQ_A5F7D4CDA63C3C2E ON concessionary;');
        $this->addSql('ALTER TABLE concessionary CHANGE citizen_id citizen_mx_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE concessionary ADD CONSTRAINT FK_A5F7D4CDE741E5E3 FOREIGN KEY (citizen_mx_id) REFERENCES citizen_mx (id);');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A5F7D4CDE741E5E3 ON concessionary (citizen_mx_id);');
        $this->addSql('ALTER TABLE concessionary_audit CHANGE citizen_id citizen_mx_id INT DEFAULT NULL;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
