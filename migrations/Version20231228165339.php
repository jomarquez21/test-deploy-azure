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

final class Version20231228165339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update `User::$hasAccessToAllSalesCenters` value for all existing users.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE `user` SET `has_access_to_all_sales_centers` = 1;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('UPDATE `user` SET `has_access_to_all_sales_centers` = 0;');
    }

    public function isTransactional(): bool
    {
        return true;
    }
}
