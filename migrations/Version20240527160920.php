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

final class Version20240527160920 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add view to list generated promissory notes.';
    }

    public function up(Schema $schema): void
    {
        $sqlString = <<<'SQL'
            CREATE VIEW v_pagares_pagares AS
                SELECT
                    sc.code AS codigo_ceve,
                    pn.id AS pagare_id,
                    c.party_number AS codigo_cliente,
                    d.id AS distribucion,
                    c2.name AS nombre_concesionario,
                    pn.amount AS monto,
                    pn.created_at AS fecha_pagare,
                    CASE
                        WHEN NOW() > pn.due_at AND pn.status = 'current' THEN 'Vencido'
                        WHEN pn.status = 'current' THEN 'Vigente'
                        WHEN pn.status = 'paid' THEN 'Pagado'
                        WHEN pn.status = 'uncollectible' THEN 'Incobrable'
                    END AS estatus
                FROM
                    promissory_note pn
                INNER JOIN
                    sales_center sc on pn.sales_center_id = sc.id
                INNER JOIN
                    client c on pn.client_id = c.id
                INNER JOIN
                    distribution d on pn.id = d.promissory_note_id
                INNER JOIN
                    concessionary c2 on pn.concessionary_id = c2.id
                ORDER BY pn.created_at DESC;
            SQL;

        $this->addSql($sqlString);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP VIEW IF EXISTS v_pagares_pagares;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
