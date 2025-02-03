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

final class Version20240125153031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Replace the role `ROLE_ADMIN_TOWN_ALL` by `ROLE_ADMIN_COLONY_ALL` at the `role_group` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE role_group SET roles = REPLACE(roles, \'ROLE_ADMIN_TOWN_ALL\', \'ROLE_ADMIN_COLONY_ALL\') WHERE roles LIKE \'%ROLE_ADMIN_TOWN_ALL%\';');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('UPDATE role_group SET roles = REPLACE(roles, \'ROLE_ADMIN_COLONY_ALL\', \'ROLE_ADMIN_TOWN_ALL\') WHERE roles LIKE \'%ROLE_ADMIN_COLONY_ALL%\';');
    }

    public function isTransactional(): bool
    {
        return true;
    }
}
