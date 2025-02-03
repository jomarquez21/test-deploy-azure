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

final class Version20231109165354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update `town_id` column in `citizen` and `sales_center` tables to make it nullable.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE citizen CHANGE town_id town_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE sales_center CHANGE town_id town_id INT DEFAULT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE citizen CHANGE town_id town_id INT NOT NULL;');
        $this->addSql('ALTER TABLE sales_center CHANGE town_id town_id INT NOT NULL;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
