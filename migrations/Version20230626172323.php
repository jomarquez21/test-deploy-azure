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

final class Version20230626172323 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `unique_bank_country_idx` constraint into `bank` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP INDEX UNIQ_D860BF7A5E237E06 ON bank;');
        $this->addSql('CREATE UNIQUE INDEX unique_bank_country_idx ON bank (name, country_id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE bank ADD CONSTRAINT INDEX UNIQ_D860BF7A5E237E06 ON bank;');
        $this->addSql('DROP unique_bank_country_idx;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
