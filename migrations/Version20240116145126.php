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

final class Version20240116145126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Alter `organization`, `sales_center` and `citizen` tables to set `colony_id` `not null`.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE organization CHANGE colony_id colony_id INT NOT NULL;');
        $this->addSql('ALTER TABLE sales_center CHANGE colony_id colony_id INT NOT NULL;');
        $this->addSql('ALTER TABLE citizen CHANGE colony_id colony_id INT NOT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE organization CHANGE colony_id colony_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE sales_center CHANGE colony_id colony_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE citizen CHANGE colony_id colony_id INT DEFAULT NULL;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
