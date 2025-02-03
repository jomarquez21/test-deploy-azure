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

final class Version20230920215036 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Delete the unique constraint for the "name" and "code" columns and added a unique constraint composed of the "name" and "brand" columns for the "product_category" table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP INDEX UNIQ_CDFC73565E237E06 ON product_category;');
        $this->addSql('DROP INDEX UNIQ_CDFC735677153098 ON product_category;');
        $this->addSql('CREATE UNIQUE INDEX unique_name_brand_idx ON product_category (name, brand_id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX unique_name_brand_idx ON product_category;');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CDFC73565E237E06 ON product_category (name);');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CDFC735677153098 ON product_category (code);');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
