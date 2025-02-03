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

final class Version20230630191243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `unique_municipality_state_idx` constraint to `municipality` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP INDEX UNIQ_C6F566285E237E06 ON municipality;');
        $this->addSql('CREATE UNIQUE INDEX unique_municipality_state_idx ON municipality (name, state_id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX unique_municipality_state_idx ON municipality;');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C6F566285E237E06 ON municipality (name);');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
