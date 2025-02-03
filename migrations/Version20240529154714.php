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

final class Version20240529154714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add view to list payment-registry-type policy movements.';
    }

    public function up(Schema $schema): void
    {
        $sqlString = <<<'SQL'
            CREATE VIEW v_poliza_pagares AS
                SELECT
                    je.sales_center_code AS codigo_ceve,
                    je.operation_date_reference AS fecha_operacion_transaccion,
                    je.source_system AS sistema_origen,
                    je.country_code AS codigo_pais,
                    je.organization_legal_code AS entidad_legal,
                    je.route_identifier AS identificador_ruta,
                    je.layout_version AS version_layout,
                    je.cost_center_code AS centro_costos,
                    prje.lines_number AS numero_lineas,
                    prje.payment_registry_type AS consecutivo_deposito,
                    prje.concessionary_bank_reference AS codigo_bancario,
                    prje.payment_registry_bank_transaction_number AS ficha_deposito,
                    prje.promissory_note_amount AS importe_pagare,
                    prje.payment_registry_amount AS importe_deposito,
                    prje.payment_registry_amount_difference AS diferencia_importe_liquidado,
                    prje.promissory_note_created_at_reference AS fecha_documento,
                    prje.promissory_note_number AS folio,
                    prje.client_name AS nombre_expendedor,
                    CASE
                        WHEN je.status = 'process-success' THEN 'procesado'
                        WHEN je.status = 'processing' THEN 'trabajando'
                        WHEN je.status = 'process-failure' THEN 'error'
                        WHEN je.status = 'unprocessed' THEN 'sin-procesar'
                    END AS estatus
                FROM
                    journal_entry je
                INNER JOIN
                    payment_registry_journal_entry prje on je.id = prje.id
                WHERE
                    je.type = 'payment-registry-journal-entry'
                ORDER BY
                    je.id ASC;
            SQL;
        $this->addSql($sqlString);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP VIEW IF EXISTS v_poliza_pagares;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
