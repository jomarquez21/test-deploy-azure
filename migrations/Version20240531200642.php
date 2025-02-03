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

final class Version20240531200642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add view to list what was sent to sweeps.';
    }

    public function up(Schema $schema): void
    {
        $sqlString = <<<'SQL'
            CREATE VIEW v_proceso_barredura AS
            SELECT
                 barredura.codigo_ceve,
                 barredura.fecha_proceso,
                 barredura.item,
                 barredura.cantidad_barredura,
                 barredura.cantidad_no_entregado,
                 (barredura.cantidad_barredura + cantidad_no_entregado) AS total_barredura,
                 barredura.fecha_hora_envio,
                 barredura.barredura_fechas_proceso,
                 barredura.no_entregado_fechas_proceso
                FROM
                (
                    SELECT
                        sc.code AS codigo_ceve,
                        -- When two or more dates are accumulated to be sent to sweeping, all the data is grouped in
                        -- the most recent date and this date is the one taken as "process_date".
                        MAX(cg.operation_reference) AS fecha_proceso,
                        p.internal_code AS item,
                        SUM(c.quantity_sweep) AS cantidad_barredura,
                        -- quantity_not_delivered: obtained by searching the "distribution" table for all records that
                        -- have the same date of shipment to sweep (`sweep_at`), the same sales center
                        -- (`sales_center_id`) and the same product (`product_id` ) of the `classification_group` that
                        -- were sent to sweep, they are grouped by the product and the `quantity_auction` and
                        -- `quantity_concessionary` columns must be added.
                        IFNULL(
                            (
                                SELECT
                                    SUM(IFNULL(sub_dp.quantity_auction, 0) + IFNULL(sub_dp.quantity_concessionary, 0))
                                FROM
                                    distribution sub_d
                                INNER JOIN
                                    distribution_distribution_products sub_ddp on sub_d.id = sub_ddp.distribution_id
                                INNER JOIN
                                    distribution_product sub_dp on sub_ddp.distribution_product_id = sub_dp.id
                                WHERE
                                    sub_d.swept_at = cg.swept_at
                                    AND sub_d.sales_center_id = cg.sales_center_id
                                    AND sub_dp.product_id = c.product_id
                                GROUP BY sub_dp.product_id
                            ),
                            0
                        ) AS cantidad_no_entregado,
                        -- The process dates are listed for the sweeps that were sent together.
                        GROUP_CONCAT(DISTINCT cg.operation_reference SEPARATOR '|') AS barredura_fechas_proceso,
                        -- Processing dates are listed for unsent distributions that were sent along with other sweeps
                        -- and, therefore, are ultimately considered "sweeps."
                        (
                            SELECT
                                GROUP_CONCAT(DISTINCT sub2_d.operation_reference SEPARATOR '|')
                            FROM distribution sub2_d
                            WHERE sub2_d.swept_at = cg.swept_at AND sub2_d.sales_center_id = c.sales_center_id
                        ) AS no_entregado_fechas_proceso,
                        cg.swept_at AS fecha_hora_envio
                    FROM
                        classification c
                    INNER JOIN
                        classification_group cg on c.classification_group_id = cg.id
                    INNER JOIN
                        sales_center sc on c.sales_center_id = sc.id
                    INNER JOIN
                        product p on c.product_id = p.id
                    WHERE cg.swept_at IS NOT NULL
                    GROUP BY cg.swept_at, c.product_id, p.internal_code, cg.swept_at
                    HAVING
                        cantidad_barredura > 0
                    OR
                        cantidad_no_entregado > 0
                    ORDER BY cg.swept_at, p.internal_code
                ) AS barredura;
            SQL;
        $this->addSql($sqlString);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP VIEW IF EXISTS v_proceso_barredura;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
