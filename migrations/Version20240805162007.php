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

final class Version20240805162007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update view `v_pagares_pagos` to add multiple deposit receipts.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP VIEW IF EXISTS v_pagares_pagos;');

        $sqlString = <<<'SQL'
            CREATE VIEW v_pagares_pagos AS
                SELECT
                    sc.code AS codigo_ceve,
                    pn.id AS pagare_id,
                    c.name AS concesionario,
                    c2.name AS cliente,
                    IF (
                        pdr.id IS NULL ,
                        pr.bank_transaction_number,
                        pdr.bank_transaction_number
                    ) AS folio_transferencia,
                    IF (
                        pdr.id IS NULL ,
                        pr.payment_date,
                        pdr.payment_date
                    ) AS fecha_transferencia,
                    pr.created_at AS fecha_registro_pago,
                    IF (
                        pdr.id IS NULL ,
                        b.name,
                        pdr_bank.name
                    ) AS banco,
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
                LEFT JOIN
                    payment_deposit_receipt pdr ON pr.id = pdr.payment_registry_id
                LEFT JOIN bank pdr_bank ON pdr.bank_id = pdr_bank.id
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

    public function isTransactional(): bool
    {
        return false;
    }
}
