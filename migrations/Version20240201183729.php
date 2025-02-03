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

final class Version20240201183729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `RawClient::$partyNumber` and make `RawClient::$client` nullable.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE raw_client ADD party_number VARCHAR(255) DEFAULT NULL, CHANGE client_id client_id INT DEFAULT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE raw_client DROP party_number, CHANGE client_id client_id INT NOT NULL;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
