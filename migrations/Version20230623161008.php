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

final class Version20230623161008 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Drop unnecessary columns and add missing columns to `sales_center`, `concessionary`, `bank`, `citizen_mx`, `municipality` and `client` tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sales_center DROP FOREIGN KEY FK_6204B92CA918EC96;');
        $this->addSql('DROP INDEX IDX_6204B92CA918EC96 ON sales_center;');
        $this->addSql('ALTER TABLE sales_center DROP sales_center_base, DROP neighborhood_code, DROP neighborhood_description;');
        $this->addSql('ALTER TABLE concessionary ADD account_number VARCHAR(255) NOT NULL;');
        $this->addSql('ALTER TABLE bank ADD code VARCHAR(255) NOT NULL;');
        $this->addSql('ALTER TABLE citizen_mx CHANGE internal_number internal_number VARCHAR(255) DEFAULT NULL;');
        $this->addSql('CREATE TABLE municipality (id INT AUTO_INCREMENT NOT NULL, state_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_C6F566285E237E06 (name), INDEX IDX_C6F566285D83CC1 (state_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE municipality ADD CONSTRAINT FK_C6F566285D83CC1 FOREIGN KEY (state_id) REFERENCES state (id);');
        $this->addSql('ALTER TABLE citizen_mx ADD municipality_id INT NOT NULL, CHANGE internal_number internal_number VARCHAR(255) DEFAULT NULL;');
        $this->addSql('ALTER TABLE citizen_mx ADD CONSTRAINT FK_D651A565AE6F181C FOREIGN KEY (municipality_id) REFERENCES municipality (id);');
        $this->addSql('CREATE INDEX IDX_D651A565AE6F181C ON citizen_mx (municipality_id);');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045575E23604;');
        $this->addSql('DROP INDEX IDX_C744045575E23604 ON client;');
        $this->addSql('ALTER TABLE client ADD state VARCHAR(255) DEFAULT NULL, ADD municipality VARCHAR(255) DEFAULT NULL, ADD town VARCHAR(255) DEFAULT NULL, DROP town_id;');
        $this->addSql('ALTER TABLE town DROP FOREIGN KEY FK_4CE6C7A45D83CC1;');
        $this->addSql('DROP INDEX unique_name_state_idx ON town;');
        $this->addSql('DROP INDEX IDX_4CE6C7A45D83CC1 ON town;');
        $this->addSql('ALTER TABLE town ADD municipality_id INT NOT NULL, DROP state_id;');
        $this->addSql('ALTER TABLE town ADD CONSTRAINT FK_4CE6C7A4AE6F181C FOREIGN KEY (municipality_id) REFERENCES municipality (id);');
        $this->addSql('CREATE INDEX IDX_4CE6C7A4AE6F181C ON town (municipality_id);');
        $this->addSql('CREATE UNIQUE INDEX unique_name_municipality_idx ON town (name, municipality_id);');
        $this->addSql('ALTER TABLE sales_center ADD municipality_id INT NOT NULL;');
        $this->addSql('ALTER TABLE sales_center ADD CONSTRAINT FK_6204B92CAE6F181C FOREIGN KEY (municipality_id) REFERENCES municipality (id);');
        $this->addSql('CREATE INDEX IDX_6204B92CAE6F181C ON sales_center (municipality_id);');
        $this->addSql('ALTER TABLE citizen_mx ADD country_id INT NOT NULL;');
        $this->addSql('ALTER TABLE citizen_mx ADD CONSTRAINT FK_D651A565F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id);');
        $this->addSql('CREATE INDEX IDX_D651A565F92F3E70 ON citizen_mx (country_id);');
        $this->addSql('CREATE TABLE municipality_audit (id INT NOT NULL, rev INT NOT NULL, state_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', revtype VARCHAR(4) NOT NULL, INDEX rev_9e2698c2e8f64240192bd197344f46fa_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE municipality_audit ADD CONSTRAINT rev_9e2698c2e8f64240192bd197344f46fa_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('ALTER TABLE citizen_mx_audit ADD municipality_id INT DEFAULT NULL, ADD country_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE client_audit ADD state VARCHAR(255) DEFAULT NULL, ADD municipality VARCHAR(255) DEFAULT NULL, ADD town VARCHAR(255) DEFAULT NULL, DROP town_id;');
        $this->addSql('ALTER TABLE concessionary_audit ADD account_number VARCHAR(255) DEFAULT NULL;');
        $this->addSql('ALTER TABLE bank_audit ADD code VARCHAR(255) DEFAULT NULL;');
        $this->addSql('ALTER TABLE town_audit CHANGE state_id municipality_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE sales_center_audit DROP neighborhood_code, DROP neighborhood_description, CHANGE sales_center_base municipality_id INT DEFAULT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sales_center ADD FOREIGN KEY FK_6204B92CA918EC96;');
        $this->addSql('ALTER TABLE sales_center ADD sales_center_base, ADD neighborhood_code, ADD neighborhood_description;');
        $this->addSql('ALTER TABLE concessionary DROP account_number;');
        $this->addSql('ALTER TABLE bank DROP code;');
        $this->addSql('DROP TABLE municipality ;');
        $this->addSql('ALTER TABLE municipality DROP CONSTRAINT FK_C6F566285D83CC1;');
        $this->addSql('ALTER TABLE citizen_mx DROP municipality_id INT NOT NULL;');
        $this->addSql('ALTER TABLE citizen_mx DROP CONSTRAINT FK_D651A565AE6F181C FOREIGN KEY (municipality_id) REFERENCES municipality (id);');
        $this->addSql('ALTER TABLE client DROP state VARCHAR(255) DEFAULT NULL, DROP municipality VARCHAR(255) DEFAULT NULL, DROP town VARCHAR(255) DEFAULT NULL, ADD town_id;');
        $this->addSql('ALTER TABLE town DROP municipality_id INT NOT NULL, DROP state_id;');
        $this->addSql('ALTER TABLE town DROP CONSTRAINT FK_4CE6C7A4AE6F181C FOREIGN KEY (municipality_id) REFERENCES municipality (id);');
        $this->addSql('ALTER TABLE sales_center DROP municipality_id INT NOT NULL;');
        $this->addSql('ALTER TABLE sales_center DROP CONSTRAINT FK_6204B92CAE6F181C FOREIGN KEY (municipality_id) REFERENCES municipality (id);');
        $this->addSql('ALTER TABLE citizen_mx DROP country_id INT NOT NULL;');
        $this->addSql('ALTER TABLE citizen_mx DROP CONSTRAINT FK_D651A565F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id);');
        $this->addSql('ALTER TABLE sales_center DROP CONSTRAINT FK_6204B92CAE6F181C;');
        $this->addSql('DROP INDEX IDX_D651A565F92F3E70 ON citizen_mx (country_id);');
        $this->addSql('ALTER TABLE town DROP COLUMNS municipality_id INT NOT NULL;');
        $this->addSql('ALTER TABLE town ADD state_id;');
        $this->addSql('DROP TABLE client;');
        $this->addSql('DROP TABLE municipality_audit;');
        $this->addSql('ALTER TABLE citizen_mx_audit DROP municipality_id;');
        $this->addSql('ALTER TABLE citizen_mx_audit DROP country_id;');
        $this->addSql('ALTER TABLE client_audit DROP state;');
        $this->addSql('ALTER TABLE client_audit DROP municipality;');
        $this->addSql('ALTER TABLE client_audit DROP town;');
        $this->addSql('ALTER TABLE concessionary_audit DROP account_number;');
        $this->addSql('ALTER TABLE bank_audit DROP code;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
