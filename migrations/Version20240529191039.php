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

final class Version20240529191039 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add migration to list payments detail for promissory notes.';
    }

    public function up(Schema $schema): void
    {
        $sqlString = <<<'SQL'
            CREATE VIEW v_pagares_pagos AS
                SELECT
                    sc.code AS codigo_ceve,
                    pn.id AS pagare_id,
                    c.name AS concesionario,
                    c2.name AS cliente,
                    pr.bank_transaction_number AS folio_transferencia,
                    pr.payment_date AS fecha_transferencia,
                    pr.created_at AS fecha_registro_pago,
                    b.name AS banco,
                    c.bank_reference AS referencia,
                    c.account_number AS cuenta,
                    c.agreement AS convenio,
                    IF
                        (pr.status = 'uncollectible', 'si', 'no') AS incobrable,
                    pr.amount AS monto_pago,
                    pn.amount AS monto_pagare
                FROM
                    promissory_note pn
                INNER JOIN
                    sales_center sc on pn.sales_center_id = sc.id
                INNER JOIN
                    payment_registry pr on pn.payment_registry_id = pr.id
                INNER JOIN
                    concessionary c on pn.concessionary_id = c.id
                INNER JOIN
                    client c2 on c.client_id = c2.id
                INNER JOIN
                    bank b on c.bank_id = b.id
                ORDER BY
                    pn.id ASC;
            SQL;

        $this->addSql($sqlString);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP VIEW IF EXISTS v_pagares_pagos;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
