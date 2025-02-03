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

final class Version20240201183730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update `RawClient::$partyNumber` value from `RawClient::$data`.';
    }

    public function up(Schema $schema): void
    {
        // The magic number 19 is the length of `\"PartyNumber\":\"` plus one. We don't use the `LENGTH()` function here
        // because When the migration is run, the count of escaped characters is wrong.
        $this->addSql('UPDATE `raw_client` SET `party_number` = SUBSTRING(REGEXP_SUBSTR(`data`, \'\\\\\\\\"PartyNumber\\\\\\\\":\\\\\\\\"([a-zA-Z0-9]+)\'), 19);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('UPDATE `raw_client` SET `party_number` = NULL;');
    }

    public function isTransactional(): bool
    {
        return true;
    }
}
