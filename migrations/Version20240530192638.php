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

final class Version20240530192638 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add view to list distribution movements.';
    }

    public function up(Schema $schema): void
    {
        $sqlString = <<<'SQL'
            CREATE VIEW v_proceso_distribucion_encabezado AS
            SELECT
                    sc.code AS codigo_ceve,
                    d.operation_reference AS fecha_proceso,
                    d.id AS distribucion,
                    cl.party_number AS codigo_cliente,
                    c.name AS nombre_concesionario,
                    CASE
                        WHEN d.status = 'billing-pending' THEN 'distribuido'
                        WHEN d.status = 'billing-success' THEN 'distribuido'
                        WHEN d.status = 'billing-failure' THEN 'distribuido'
                        WHEN d.status = 'delivering' THEN 'distribuido'
                        WHEN d.status = 'delivery-success' THEN 'entregado'
                        WHEN d.status = 'delivery-failure' THEN 'distribuido'
                        WHEN d.status = 'distributing' THEN 'distribuido'
                        WHEN d.status = 'distribution-success' THEN 'distribuido'
                        WHEN d.status = 'distribution-failure' THEN 'distribuido'
                        WHEN d.status = 'reassigning' THEN 'distribuido'
                        WHEN d.status = 'reassignment-success' THEN 'reasignado'
                        WHEN d.status = 'reassignment-failure' THEN 'distribuido'
                        WHEN d.status = 'sweeping' THEN 'distribuido'
                        WHEN d.status = 'sweep-success' THEN 'distribuido'
                        WHEN d.status = 'sweep-failure' THEN 'distribuido'
                    END AS estatus,
                    d.total_quantity_concessionary AS recuperacion_piezas,
                    d.total_amount_concessionary AS recuperacion_monto,
                    d.total_quantity_auction AS remate_piezas,
                    d.total_amount_auction AS remate_monto,
                    inv.external_id as UUID,
                    LPAD(pn.id, 5, '0') as codigo_pagare,
                    d.target_distribution_id AS distribucion_destino,
                    CASE
                        WHEN
                        d.target_distribution_id IS NULL THEN 'no'
                        ELSE 'si'
                    END AS reasignado,
                    d.delivered_at AS fecha_entrega,
                    d.swept_at as fecha_barredura
                FROM
                    distribution d
                LEFT JOIN
                    sales_center sc on sc.id = d.sales_center_id
                LEFT JOIN
                    concessionary c on c.id = d.concessionary_id
                LEFT JOIN
                    client cl on cl.id = c.client_id
                LEFT JOIN
                    invoice inv on inv.id = d.invoice_id
                LEFT JOIN
                    promissory_note pn on pn.id = d.promissory_note_id
                ORDER BY
                    d.id ASC;
            SQL;
        $this->addSql($sqlString);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP VIEW IF EXISTS v_proceso_distribucion_encabezado;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
