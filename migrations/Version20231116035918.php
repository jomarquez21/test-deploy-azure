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

final class Version20231116035918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Migration Version20231116035918.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE devolution_system_pack (id INT AUTO_INCREMENT NOT NULL, devolution_system_id INT NOT NULL, classification_group_id INT DEFAULT NULL, devolution_return_id INT NOT NULL, sales_center_id INT NOT NULL, quantity INT NOT NULL, code VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_E2B4FC35BEB3A550 (devolution_system_id), INDEX IDX_E2B4FC357BC2BA17 (classification_group_id), INDEX IDX_E2B4FC354C529C20 (devolution_return_id), INDEX IDX_E2B4FC35657CAB3E (sales_center_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE devolution_system_pack ADD CONSTRAINT FK_E2B4FC35BEB3A550 FOREIGN KEY (devolution_system_id) REFERENCES devolution_system (id);');
        $this->addSql('ALTER TABLE devolution_system_pack ADD CONSTRAINT FK_E2B4FC357BC2BA17 FOREIGN KEY (classification_group_id) REFERENCES classification_group (id);');
        $this->addSql('ALTER TABLE devolution_system_pack ADD CONSTRAINT FK_E2B4FC354C529C20 FOREIGN KEY (devolution_return_id) REFERENCES devolution_return (id);');
        $this->addSql('ALTER TABLE devolution_system_pack ADD CONSTRAINT FK_E2B4FC35657CAB3E FOREIGN KEY (sales_center_id) REFERENCES sales_center (id);');
        $this->addSql('ALTER TABLE devolution_return ADD warehouse VARCHAR(255) DEFAULT NULL, ADD region VARCHAR(255) DEFAULT NULL, ADD devolution_reference VARCHAR(255) DEFAULT NULL, ADD control_number INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE devolution_system_product ADD devolution_return_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE devolution_system_product ADD CONSTRAINT FK_FAB78D374C529C20 FOREIGN KEY (devolution_return_id) REFERENCES devolution_return (id);');
        $this->addSql('CREATE INDEX IDX_FAB78D374C529C20 ON devolution_system_product (devolution_return_id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE devolution_system_pack DROP FOREIGN KEY FK_E2B4FC35BEB3A550;');
        $this->addSql('ALTER TABLE devolution_system_pack DROP FOREIGN KEY FK_E2B4FC357BC2BA17;');
        $this->addSql('ALTER TABLE devolution_system_pack DROP FOREIGN KEY FK_E2B4FC354C529C20;');
        $this->addSql('ALTER TABLE devolution_system_pack DROP FOREIGN KEY FK_E2B4FC35657CAB3E;');
        $this->addSql('DROP TABLE devolution_system_pack;');
        $this->addSql('ALTER TABLE devolution_return DROP warehouse, DROP region, DROP devolution_reference, DROP control_number;');
        $this->addSql('ALTER TABLE devolution_system_product DROP FOREIGN KEY FK_FAB78D374C529C20;');
        $this->addSql('DROP INDEX IDX_FAB78D374C529C20 ON devolution_system_product;');
        $this->addSql('ALTER TABLE devolution_system_product DROP devolution_return_id;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
