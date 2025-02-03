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

final class Version20240202134447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Remove `debt` column on `concessionary` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE concessionary DROP COLUMN debt;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE concessionary ADD COLUMN debt DOUBLE NOT NULL DEFAULT \'0\';');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
