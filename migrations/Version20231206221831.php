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

final class Version20231206221831 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update empty values in `type` column in `distribution` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE distribution SET type = \'normal\' WHERE type IS NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('UPDATE distribution SET type = NULL;');
    }

    public function isTransactional(): bool
    {
        return true;
    }
}
