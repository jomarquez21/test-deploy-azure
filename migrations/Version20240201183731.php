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

final class Version20240201183731 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add unique constraint for `RawClient::$partyNumber` and add index for searching by party number.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE raw_client CHANGE party_number party_number VARCHAR(255) NOT NULL;');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5FA00C15D0E6640D ON raw_client (party_number);');
        $this->addSql('CREATE INDEX search_by_party_number_idx ON client (party_number);');
        $this->addSql('CREATE INDEX search_by_party_number_idx ON raw_client (party_number);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX UNIQ_5FA00C15D0E6640D ON raw_client;');
        $this->addSql('DROP INDEX search_by_party_number_idx ON client;');
        $this->addSql('DROP INDEX search_by_party_number_idx ON raw_client;');
        $this->addSql('ALTER TABLE raw_client CHANGE party_number party_number VARCHAR(255) DEFAULT NULL;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
