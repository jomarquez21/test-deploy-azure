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

final class Version20231110065829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `distribution_product_audit` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE distribution_product_audit (id INT NOT NULL, rev INT NOT NULL, product_id INT DEFAULT NULL, concessionary_id INT DEFAULT NULL, quantity_auction INT DEFAULT NULL, quantity_concessionary INT DEFAULT NULL, product_price_auction DOUBLE PRECISION DEFAULT NULL, product_price_concessionary DOUBLE PRECISION DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', revtype VARCHAR(4) NOT NULL, INDEX rev_431bd2e8b54b27785d4f59c9cab00ae9_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE distribution_product_audit ADD CONSTRAINT rev_431bd2e8b54b27785d4f59c9cab00ae9_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE distribution_product_audit DROP FOREIGN KEY rev_431bd2e8b54b27785d4f59c9cab00ae9_fk;');
        $this->addSql('DROP TABLE distribution_product_audit;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
