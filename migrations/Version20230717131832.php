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

final class Version20230717131832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add tables `devolution_return`, `devolution_system`, `classification`, `devolution_system_product`.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE classification (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, classification_group_id INT NOT NULL, quantity INT DEFAULT 0 NOT NULL, quantity_auction INT DEFAULT 0 NOT NULL, quantity_concessionary INT DEFAULT 0 NOT NULL, quantity_sweep INT DEFAULT 0 NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_456BD2314584665A (product_id), INDEX IDX_456BD2317BC2BA17 (classification_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE classification_audit (id INT NOT NULL, rev INT NOT NULL, product_id INT DEFAULT NULL, classification_group_id INT DEFAULT NULL, quantity INT DEFAULT 0, quantity_auction INT DEFAULT 0, quantity_concessionary INT DEFAULT 0, quantity_sweep INT DEFAULT 0, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', revtype VARCHAR(4) NOT NULL, INDEX rev_6caa66156c894bbca7dffb5b2e9c3067_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE classification_group (id INT AUTO_INCREMENT NOT NULL, sales_center_id INT NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_419D6F41657CAB3E (sales_center_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE classification_group_audit (id INT NOT NULL, rev INT NOT NULL, sales_center_id INT DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', revtype VARCHAR(4) NOT NULL, INDEX rev_0898b6fa9e591b805d00bdeb5cf969a1_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE devolution_return (id INT AUTO_INCREMENT NOT NULL, classification_group_id INT DEFAULT NULL, devolution_system_id INT NOT NULL, sales_center_id INT NOT NULL, is_return TINYINT(1) DEFAULT 0 NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_BA2684E87BC2BA17 (classification_group_id), INDEX IDX_BA2684E8BEB3A550 (devolution_system_id), INDEX IDX_BA2684E8657CAB3E (sales_center_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE devolution_system (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_D4F5AA6CF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE devolution_system_product (id INT AUTO_INCREMENT NOT NULL, devolution_system_id INT NOT NULL, classification_group_id INT DEFAULT NULL, product_id INT NOT NULL, sales_center_id INT NOT NULL, quantity INT NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_FAB78D37BEB3A550 (devolution_system_id), INDEX IDX_FAB78D377BC2BA17 (classification_group_id), INDEX IDX_FAB78D374584665A (product_id), INDEX IDX_FAB78D37657CAB3E (sales_center_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE sales_center_system (sales_center_id INT NOT NULL, devolution_system_id INT NOT NULL, INDEX IDX_61097E15657CAB3E (sales_center_id), INDEX IDX_61097E15BEB3A550 (devolution_system_id), PRIMARY KEY(sales_center_id, devolution_system_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE sales_center_system_audit (sales_center_id INT NOT NULL, devolution_system_id INT NOT NULL, rev INT NOT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_cb5c95d3ed468f3fdde11a12062d68e1_idx (rev), PRIMARY KEY(sales_center_id, devolution_system_id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE classification ADD CONSTRAINT FK_456BD2314584665A FOREIGN KEY (product_id) REFERENCES product (id);');
        $this->addSql('ALTER TABLE classification ADD CONSTRAINT FK_456BD2317BC2BA17 FOREIGN KEY (classification_group_id) REFERENCES classification_group (id);');
        $this->addSql('ALTER TABLE classification_audit ADD CONSTRAINT rev_6caa66156c894bbca7dffb5b2e9c3067_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('ALTER TABLE classification_group ADD CONSTRAINT FK_419D6F41657CAB3E FOREIGN KEY (sales_center_id) REFERENCES sales_center (id);');
        $this->addSql('ALTER TABLE classification_group_audit ADD CONSTRAINT rev_0898b6fa9e591b805d00bdeb5cf969a1_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('ALTER TABLE devolution_return ADD CONSTRAINT FK_BA2684E87BC2BA17 FOREIGN KEY (classification_group_id) REFERENCES classification_group (id);');
        $this->addSql('ALTER TABLE devolution_return ADD CONSTRAINT FK_BA2684E8BEB3A550 FOREIGN KEY (devolution_system_id) REFERENCES devolution_system (id);');
        $this->addSql('ALTER TABLE devolution_return ADD CONSTRAINT FK_BA2684E8657CAB3E FOREIGN KEY (sales_center_id) REFERENCES sales_center (id);');
        $this->addSql('ALTER TABLE devolution_system ADD CONSTRAINT FK_D4F5AA6CF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id);');
        $this->addSql('ALTER TABLE devolution_system_product ADD CONSTRAINT FK_FAB78D37BEB3A550 FOREIGN KEY (devolution_system_id) REFERENCES devolution_system (id);');
        $this->addSql('ALTER TABLE devolution_system_product ADD CONSTRAINT FK_FAB78D377BC2BA17 FOREIGN KEY (classification_group_id) REFERENCES classification_group (id);');
        $this->addSql('ALTER TABLE devolution_system_product ADD CONSTRAINT FK_FAB78D374584665A FOREIGN KEY (product_id) REFERENCES product (id);');
        $this->addSql('ALTER TABLE devolution_system_product ADD CONSTRAINT FK_FAB78D37657CAB3E FOREIGN KEY (sales_center_id) REFERENCES sales_center (id);');
        $this->addSql('ALTER TABLE sales_center_system ADD CONSTRAINT FK_61097E15657CAB3E FOREIGN KEY (sales_center_id) REFERENCES sales_center (id);');
        $this->addSql('ALTER TABLE sales_center_system ADD CONSTRAINT FK_61097E15BEB3A550 FOREIGN KEY (devolution_system_id) REFERENCES devolution_system (id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE classification DROP FOREIGN KEY FK_456BD2314584665A;');
        $this->addSql('ALTER TABLE classification DROP FOREIGN KEY FK_456BD2317BC2BA17;');
        $this->addSql('ALTER TABLE classification_audit DROP FOREIGN KEY rev_6caa66156c894bbca7dffb5b2e9c3067_fk;');
        $this->addSql('ALTER TABLE classification_group DROP FOREIGN KEY FK_419D6F41657CAB3E;');
        $this->addSql('ALTER TABLE classification_group_audit DROP FOREIGN KEY rev_0898b6fa9e591b805d00bdeb5cf969a1_fk;');
        $this->addSql('ALTER TABLE devolution_return DROP FOREIGN KEY FK_BA2684E87BC2BA17;');
        $this->addSql('ALTER TABLE devolution_return DROP FOREIGN KEY FK_BA2684E8BEB3A550;');
        $this->addSql('ALTER TABLE devolution_return DROP FOREIGN KEY FK_BA2684E8657CAB3E;');
        $this->addSql('ALTER TABLE devolution_system DROP FOREIGN KEY FK_D4F5AA6CF92F3E70;');
        $this->addSql('ALTER TABLE devolution_system_product DROP FOREIGN KEY FK_FAB78D37BEB3A550;');
        $this->addSql('ALTER TABLE devolution_system_product DROP FOREIGN KEY FK_FAB78D377BC2BA17;');
        $this->addSql('ALTER TABLE devolution_system_product DROP FOREIGN KEY FK_FAB78D374584665A;');
        $this->addSql('ALTER TABLE devolution_system_product DROP FOREIGN KEY FK_FAB78D37657CAB3E;');
        $this->addSql('ALTER TABLE sales_center_system DROP FOREIGN KEY FK_61097E15657CAB3E;');
        $this->addSql('ALTER TABLE sales_center_system DROP FOREIGN KEY FK_61097E15BEB3A550;');
        $this->addSql('DROP TABLE classification;');
        $this->addSql('DROP TABLE classification_audit;');
        $this->addSql('DROP TABLE classification_group;');
        $this->addSql('DROP TABLE classification_group_audit;');
        $this->addSql('DROP TABLE devolution_return;');
        $this->addSql('DROP TABLE devolution_system;');
        $this->addSql('DROP TABLE devolution_system_product;');
        $this->addSql('DROP TABLE sales_center_system;');
        $this->addSql('DROP TABLE sales_center_system_audit;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
