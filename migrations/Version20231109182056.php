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

final class Version20231109182056 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update `country_id` column in `organization` table to make it non-nullable.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE organization CHANGE country_id country_id INT NOT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE organization CHANGE country_id country_id INT DEFAULT NULL;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
