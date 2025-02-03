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

final class Version20230505100716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adds `sales_center` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE sales_center (id INT AUTO_INCREMENT NOT NULL, organization_id INT NOT NULL, state_id INT NOT NULL, town_id INT NOT NULL, sales_center_base INT DEFAULT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, zip_code VARCHAR(255) NOT NULL, neighborhood_code VARCHAR(255) NOT NULL, neighborhood_description VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, internal_number VARCHAR(255) NOT NULL, external_number VARCHAR(255) NOT NULL, is_recovers TINYINT(1) NOT NULL, is_active TINYINT(1) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_6204B92C5E237E06 (name), INDEX IDX_6204B92C32C8A3DE (organization_id), INDEX IDX_6204B92C5D83CC1 (state_id), INDEX IDX_6204B92C75E23604 (town_id), INDEX IDX_6204B92CA918EC96 (sales_center_base), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE sales_center ADD CONSTRAINT FK_6204B92C32C8A3DE FOREIGN KEY (organization_id) REFERENCES organization (id);');
        $this->addSql('ALTER TABLE sales_center ADD CONSTRAINT FK_6204B92C5D83CC1 FOREIGN KEY (state_id) REFERENCES state (id);');
        $this->addSql('ALTER TABLE sales_center ADD CONSTRAINT FK_6204B92C75E23604 FOREIGN KEY (town_id) REFERENCES town (id);');
        $this->addSql('ALTER TABLE sales_center ADD CONSTRAINT FK_6204B92CA918EC96 FOREIGN KEY (sales_center_base) REFERENCES sales_center (id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE sales_center;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
