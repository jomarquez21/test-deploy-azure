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

final class Version20231114192145 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Remove `price_with_taxes` column from `product_price` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product_price DROP price_with_taxes;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product_price ADD price_with_taxes DOUBLE PRECISION NOT NULL;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
