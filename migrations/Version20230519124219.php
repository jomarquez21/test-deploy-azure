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

final class Version20230519124219 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adds `category` and `category_group` tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, organization_id INT DEFAULT NULL, brand_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', categoryGroup_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_64C19C15E237E06 (name), UNIQUE INDEX UNIQ_64C19C177153098 (code), INDEX IDX_64C19C132C8A3DE (organization_id), INDEX IDX_64C19C144F5D008 (brand_id), INDEX IDX_64C19C1B4B21A12 (categoryGroup_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE category_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, is_default TINYINT(1) DEFAULT false NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_85F30B8C5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C132C8A3DE FOREIGN KEY (organization_id) REFERENCES organization (id);');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C144F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id);');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1B4B21A12 FOREIGN KEY (categoryGroup_id) REFERENCES category_group (id);');
        $this->addSql('ALTER TABLE product ADD category_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id);');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2;');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C132C8A3DE;');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C144F5D008;');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1B4B21A12;');
        $this->addSql('DROP TABLE category;');
        $this->addSql('DROP TABLE category_group;');
        $this->addSql('DROP INDEX IDX_D34A04AD12469DE2 ON product;');
        $this->addSql('ALTER TABLE product DROP category_id;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
