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

final class Version20230706122914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `product_list`, `product_price_list` and `product_price_list_audit` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE price_list (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, is_default TINYINT(1) DEFAULT 0 NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_399A0AA25E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE product_price (id INT AUTO_INCREMENT NOT NULL, price_list_id INT DEFAULT NULL, product_id INT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_6B9459855688DED7 (price_list_id), INDEX IDX_6B9459854584665A (product_id), UNIQUE INDEX UNIQ_6B9459855688DED74584665A (price_list_id, product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE product_price ADD CONSTRAINT FK_6B9459855688DED7 FOREIGN KEY (price_list_id) REFERENCES price_list (id);');
        $this->addSql('ALTER TABLE product_price ADD CONSTRAINT FK_6B9459854584665A FOREIGN KEY (product_id) REFERENCES product (id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product_price DROP FOREIGN KEY FK_6B9459855688DED7;');
        $this->addSql('ALTER TABLE product_price DROP FOREIGN KEY FK_6B9459854584665A;');
        $this->addSql('DROP TABLE price_list;');
        $this->addSql('DROP TABLE product_price;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
