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

final class Version20240530160936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add view to list distribution products details.';
    }

    public function up(Schema $schema): void
    {
        $sqlString = <<<'SQL'
            CREATE VIEW v_proceso_distribucion_contenido AS
                SELECT
                    sc.code AS codigo_ceve,
                    d.operation_reference AS fecha_proceso,
                    d.id AS distribucion,
                    p.internal_code AS item,
                    dp.quantity_concessionary AS recuperacion_piezas,
                    dp.product_price_concessionary AS precio_recuperacion,
                    ROUND
                    (
                        (dp.quantity_concessionary * dp.product_price_concessionary),
                        2
                    ) AS monto_recuperacion,
                    dp.quantity_auction AS remate_piezas,
                    dp.product_price_auction AS precio_remate,
                    ROUND
                    (
                      (dp.quantity_auction * dp.product_price_auction),
                      2
                    ) AS monto_remate,
                    (dp.quantity_auction + dp.quantity_concessionary) AS total_piezas,
                    ROUND
                    (
                        (
                            ROUND
                            (
                                (dp.quantity_concessionary * dp.product_price_concessionary),
                                2
                            ) +
                            ROUND
                            (
                                (dp.quantity_auction * dp.product_price_auction),
                                2
                            )
                        ),
                        2
                    ) AS total_monto,
                    CASE
                        WHEN d.target_distribution_id IS NULL THEN 'no'
                        ELSE 'si'
                    END AS reasignado,
                    d.target_distribution_id AS distribucion_destino
                FROM
                    distribution_product dp
                INNER JOIN
                    sales_center sc on dp.sales_center_id = sc.id
                INNER JOIN
                    distribution_distribution_products ddp on dp.id = ddp.distribution_product_id
                INNER JOIN
                    distribution d on ddp.distribution_id = d.id
                INNER JOIN
                    product p on dp.product_id = p.id;
            SQL;
        $this->addSql($sqlString);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP VIEW IF EXISTS v_proceso_distribucion_contenido;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
