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

final class Version20240514214908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add view to list bank catalog.';
    }

    public function up(Schema $schema): void
    {
        $sqlString = <<<'SQL'
            CREATE VIEW v_catalogo_bancos AS
                SELECT
                    bank.code AS codigo,
                    bank.name AS nombre,
                    country.name AS pais
                FROM
                    bank
                INNER JOIN
                    country ON bank.country_id = country.id;
            SQL;

        $this->addSql($sqlString);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP VIEW IF EXISTS v_catalogo_bancos;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
