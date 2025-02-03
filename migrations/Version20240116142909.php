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

final class Version20240116142909 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update value to `colony_id` for `organization`, `sales_center` and `citizen` tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE organization SET colony_id = (SELECT c.id FROM municipality m LEFT JOIN colony c ON m.id = c.municipality_id WHERE m.id = organization.municipality_id LIMIT 1);');
        $this->addSql('UPDATE sales_center SET colony_id = (SELECT c.id FROM municipality m LEFT JOIN colony c ON m.id = c.municipality_id WHERE m.id = sales_center.municipality_id LIMIT 1);');
        $this->addSql('UPDATE citizen SET colony_id = (SELECT c.id FROM municipality m LEFT JOIN colony c ON m.id = c.municipality_id WHERE m.id = citizen.municipality_id LIMIT 1);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('UPDATE organization SET colony_id = NULL;');
        $this->addSql('UPDATE sales_center SET colony_id = NULL;');
        $this->addSql('UPDATE citizen SET colony_id = NULL;');
    }

    public function isTransactional(): bool
    {
        return true;
    }
}
