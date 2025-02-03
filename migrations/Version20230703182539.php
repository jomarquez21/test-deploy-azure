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

final class Version20230703182539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `category_audit` and `category_group_audit` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2;');
        $this->addSql('CREATE TABLE product_category (id INT AUTO_INCREMENT NOT NULL, organization_id INT DEFAULT NULL, brand_id INT DEFAULT NULL, product_category_group_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_CDFC73565E237E06 (name), UNIQUE INDEX UNIQ_CDFC735677153098 (code), INDEX IDX_CDFC735632C8A3DE (organization_id), INDEX IDX_CDFC735644F5D008 (brand_id), INDEX IDX_CDFC7356FDAB6F6F (product_category_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE product_category_audit (id INT NOT NULL, rev INT NOT NULL, organization_id INT DEFAULT NULL, brand_id INT DEFAULT NULL, product_category_group_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', revtype VARCHAR(4) NOT NULL, INDEX rev_6150659e9e0580eefc12807c8b5101bb_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE product_category_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, is_default TINYINT(1) DEFAULT 0 NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_D69A75A05E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE product_category_group_audit (id INT NOT NULL, rev INT NOT NULL, name VARCHAR(255) DEFAULT NULL, is_default TINYINT(1) DEFAULT 0, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', revtype VARCHAR(4) NOT NULL, INDEX rev_25336c08d6c6692c2d85241851f314d7_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC735632C8A3DE FOREIGN KEY (organization_id) REFERENCES organization (id);');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC735644F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id);');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC7356FDAB6F6F FOREIGN KEY (product_category_group_id) REFERENCES product_category_group (id);');
        $this->addSql('ALTER TABLE product_category_audit ADD CONSTRAINT rev_6150659e9e0580eefc12807c8b5101bb_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('ALTER TABLE product_category_group_audit ADD CONSTRAINT rev_25336c08d6c6692c2d85241851f314d7_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C144F5D008;');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1B4B21A12;');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C132C8A3DE;');
        $this->addSql('DROP TABLE category;');
        $this->addSql('DROP TABLE category_group;');
        $this->addSql('DROP INDEX IDX_D34A04AD12469DE2 ON product;');
        $this->addSql('ALTER TABLE product CHANGE category_id product_category_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADBE6903FD FOREIGN KEY (product_category_id) REFERENCES product_category (id);');
        $this->addSql('CREATE INDEX IDX_D34A04ADBE6903FD ON product (product_category_id);');
        $this->addSql('ALTER TABLE product_audit CHANGE category_id product_category_id INT DEFAULT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADBE6903FD;');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, organization_id INT DEFAULT NULL, brand_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, code VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', categoryGroup_id INT DEFAULT NULL, INDEX IDX_64C19C132C8A3DE (organization_id), INDEX IDX_64C19C1B4B21A12 (categoryGroup_id), UNIQUE INDEX UNIQ_64C19C15E237E06 (name), UNIQUE INDEX UNIQ_64C19C177153098 (code), INDEX IDX_64C19C144F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\';');
        $this->addSql('CREATE TABLE category_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, is_default TINYINT(1) DEFAULT 0 NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_85F30B8C5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ;');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C144F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id);');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1B4B21A12 FOREIGN KEY (categoryGroup_id) REFERENCES category_group (id);');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C132C8A3DE FOREIGN KEY (organization_id) REFERENCES organization (id);');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC735632C8A3DE;');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC735644F5D008;');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC7356FDAB6F6F;');
        $this->addSql('ALTER TABLE product_category_audit DROP FOREIGN KEY rev_6150659e9e0580eefc12807c8b5101bb_fk;');
        $this->addSql('ALTER TABLE product_category_group_audit DROP FOREIGN KEY rev_25336c08d6c6692c2d85241851f314d7_fk;');
        $this->addSql('DROP TABLE product_category;');
        $this->addSql('DROP TABLE product_category_audit;');
        $this->addSql('DROP TABLE product_category_group;');
        $this->addSql('DROP TABLE product_category_group_audit;');
        $this->addSql('DROP INDEX IDX_D34A04ADBE6903FD ON product;');
        $this->addSql('ALTER TABLE product CHANGE product_category_id category_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id);');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id);');
        $this->addSql('ALTER TABLE product_audit CHANGE product_category_id category_id INT DEFAULT NULL;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
