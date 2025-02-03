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

final class Version20231109185353 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update `external_number` values in `sales_center` table to be able to make it non-nullable.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE sales_center set external_number = \'\' WHERE external_number IS NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('UPDATE sales_center set external_number = null WHERE external_number = \'\';');
    }

    public function isTransactional(): bool
    {
        return true;
    }
}
