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

final class Version20230817171042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update foreign keys of `products_taxes` table which were referencing a wrong column.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP INDEX UNIQ_1C52F9585E237E06 ON brand;');
        $this->addSql('ALTER TABLE products_taxes DROP FOREIGN KEY FK_22D759284584665A;');
        $this->addSql('ALTER TABLE products_taxes DROP FOREIGN KEY FK_22D75928B2A824D8;');
        $this->addSql('ALTER TABLE products_taxes ADD CONSTRAINT FK_22D759284584665A FOREIGN KEY (product_id) REFERENCES product (id);');
        $this->addSql('ALTER TABLE products_taxes ADD CONSTRAINT FK_22D75928B2A824D8 FOREIGN KEY (tax_id) REFERENCES tax (id);');
        $this->addSql('ALTER TABLE products_taxes DROP PRIMARY KEY, ADD PRIMARY KEY (product_id, tax_id);');
        $this->addSql('ALTER TABLE products_taxes_audit DROP PRIMARY KEY, ADD PRIMARY KEY (product_id, tax_id, rev);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1C52F9585E237E06 ON brand (name);');
        $this->addSql('ALTER TABLE products_taxes DROP FOREIGN KEY FK_22D759284584665A;');
        $this->addSql('ALTER TABLE products_taxes DROP FOREIGN KEY FK_22D75928B2A824D8;');
        $this->addSql('ALTER TABLE products_taxes ADD CONSTRAINT FK_22D759284584665A FOREIGN KEY (product_id) REFERENCES tax (id);');
        $this->addSql('ALTER TABLE products_taxes ADD CONSTRAINT FK_22D75928B2A824D8 FOREIGN KEY (tax_id) REFERENCES product (id);');
        $this->addSql('ALTER TABLE products_taxes DROP PRIMARY KEY, ADD PRIMARY KEY (tax_id, product_id);');
        $this->addSql('ALTER TABLE products_taxes_audit DROP PRIMARY KEY, ADD PRIMARY KEY (tax_id, product_id, rev);');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
