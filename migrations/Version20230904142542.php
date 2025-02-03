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

final class Version20230904142542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `distribution`, `distribution_distribution_products` and `distribution_product` tables and their auditory tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE distribution (id INT AUTO_INCREMENT NOT NULL, concessionary_id INT DEFAULT NULL, total_quantity_auction INT NOT NULL, total_quantity_concessionary INT NOT NULL, total_quantity INT NOT NULL, total_amount_auction DOUBLE PRECISION NOT NULL, total_amount_concessionary DOUBLE PRECISION NOT NULL, total_amount DOUBLE PRECISION NOT NULL, status ENUM(\'delivered\', \'distributed\', \'reassigned\'), created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', end_of_cycle_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_A448378139BBA722 (concessionary_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE distribution_distribution_products (distribution_id INT NOT NULL, distribution_product_id INT NOT NULL, INDEX IDX_D0EB7D786EB6DDB5 (distribution_id), UNIQUE INDEX UNIQ_D0EB7D7851C2AD55 (distribution_product_id), PRIMARY KEY(distribution_id, distribution_product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE distribution_audit (id INT NOT NULL, rev INT NOT NULL, concessionary_id INT DEFAULT NULL, total_quantity_auction INT DEFAULT NULL, total_quantity_concessionary INT DEFAULT NULL, total_quantity INT DEFAULT NULL, total_amount_auction DOUBLE PRECISION DEFAULT NULL, total_amount_concessionary DOUBLE PRECISION DEFAULT NULL, total_amount DOUBLE PRECISION DEFAULT NULL, status ENUM(\'delivered\', \'distributed\', \'reassigned\'), created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', end_of_cycle_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', revtype VARCHAR(4) NOT NULL, INDEX rev_0d2391908c15a33bc5db061b64dd53b0_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE distribution_distribution_products_audit (distribution_id INT NOT NULL, distribution_product_id INT NOT NULL, rev INT NOT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_20e9b52b7372a8617fd822c9bd2d81fd_idx (rev), PRIMARY KEY(distribution_id, distribution_product_id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE distribution_product (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, concessionary_id INT DEFAULT NULL, quantity_auction INT NOT NULL, quantity_concessionary INT NOT NULL, product_price_auction DOUBLE PRECISION NOT NULL, product_price_concessionary DOUBLE PRECISION NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_33FB4A1F4584665A (product_id), INDEX IDX_33FB4A1F39BBA722 (concessionary_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE distribution ADD CONSTRAINT FK_A448378139BBA722 FOREIGN KEY (concessionary_id) REFERENCES concessionary (id);');
        $this->addSql('ALTER TABLE distribution_distribution_products ADD CONSTRAINT FK_D0EB7D786EB6DDB5 FOREIGN KEY (distribution_id) REFERENCES distribution (id);');
        $this->addSql('ALTER TABLE distribution_distribution_products ADD CONSTRAINT FK_D0EB7D7851C2AD55 FOREIGN KEY (distribution_product_id) REFERENCES distribution_product (id) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE distribution_audit ADD CONSTRAINT rev_0d2391908c15a33bc5db061b64dd53b0_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('ALTER TABLE distribution_product ADD CONSTRAINT FK_33FB4A1F4584665A FOREIGN KEY (product_id) REFERENCES product (id);');
        $this->addSql('ALTER TABLE distribution_product ADD CONSTRAINT FK_33FB4A1F39BBA722 FOREIGN KEY (concessionary_id) REFERENCES concessionary (id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE distribution DROP FOREIGN KEY FK_A448378139BBA722;');
        $this->addSql('ALTER TABLE distribution_distribution_products DROP FOREIGN KEY FK_D0EB7D786EB6DDB5;');
        $this->addSql('ALTER TABLE distribution_distribution_products DROP FOREIGN KEY FK_D0EB7D7851C2AD55;');
        $this->addSql('ALTER TABLE distribution_audit DROP FOREIGN KEY rev_0d2391908c15a33bc5db061b64dd53b0_fk;');
        $this->addSql('ALTER TABLE distribution_product DROP FOREIGN KEY FK_33FB4A1F4584665A;');
        $this->addSql('ALTER TABLE distribution_product DROP FOREIGN KEY FK_33FB4A1F39BBA722;');
        $this->addSql('DROP TABLE distribution;');
        $this->addSql('DROP TABLE distribution_distribution_products;');
        $this->addSql('DROP TABLE distribution_audit;');
        $this->addSql('DROP TABLE distribution_distribution_products_audit;');
        $this->addSql('DROP TABLE distribution_product;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
