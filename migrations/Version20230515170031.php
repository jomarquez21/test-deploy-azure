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

final class Version20230515170031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adds `brand` and `tax` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_1C52F9585E237E06 (name), UNIQUE INDEX UNIQ_1C52F95877153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE products_taxes (tax_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_22D75928B2A824D8 (tax_id), INDEX IDX_22D759284584665A (product_id), PRIMARY KEY(tax_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE tax (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, percentage DOUBLE PRECISION NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8E81BA765E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE products_taxes ADD CONSTRAINT FK_22D75928B2A824D8 FOREIGN KEY (tax_id) REFERENCES product (id);');
        $this->addSql('ALTER TABLE products_taxes ADD CONSTRAINT FK_22D759284584665A FOREIGN KEY (product_id) REFERENCES tax (id);');
        $this->addSql('ALTER TABLE product ADD organization_id INT DEFAULT NULL, ADD brand_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD32C8A3DE FOREIGN KEY (organization_id) REFERENCES organization (id);');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id);');
        $this->addSql('CREATE INDEX IDX_D34A04AD32C8A3DE ON product (organization_id);');
        $this->addSql('CREATE INDEX IDX_D34A04AD44F5D008 ON product (brand_id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD44F5D008;');
        $this->addSql('ALTER TABLE products_taxes DROP FOREIGN KEY FK_22D75928B2A824D8;');
        $this->addSql('ALTER TABLE products_taxes DROP FOREIGN KEY FK_22D759284584665A;');
        $this->addSql('DROP TABLE brand;');
        $this->addSql('DROP TABLE products_taxes;');
        $this->addSql('DROP TABLE tax;');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD32C8A3DE;');
        $this->addSql('DROP INDEX IDX_D34A04AD32C8A3DE ON product;');
        $this->addSql('DROP INDEX IDX_D34A04AD44F5D008 ON product;');
        $this->addSql('ALTER TABLE product DROP organization_id, DROP brand_id;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
