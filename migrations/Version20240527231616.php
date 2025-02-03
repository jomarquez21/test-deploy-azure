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

final class Version20240527231616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add view to list Inventory-type policy movements.';
    }

    public function up(Schema $schema): void
    {
        $sqlString = <<<'SQL'
            CREATE VIEW v_poliza_inventarios AS
                SELECT
                    je.sales_center_code AS codigo_ceve,
                    je.operation_date_reference AS fecha_operacion_transaccion,
                    je.source_system AS sistema_origen,
                    je.country_code AS codigo_pais,
                    je.organization_legal_code AS entidad_legal,
                    je.route_identifier AS identificador_ruta,
                    je.layout_version AS version_layout,
                    je.cost_center_code AS centro_costos,
                    ije.transaction_number AS numero_transaccion,
                    ije.transaction_identifier AS movimiento_id,
                    CASE
                        WHEN ije.transaction_type = 'delivery' OR ije.transaction_type = 'devolution' THEN 'TRAS'
                        WHEN ije.transaction_type = 'sweep' THEN 'DEVF'
                    END AS tipo_movimiento,
                    ije.transaction_hour AS transaccion_hora,
                    CASE
                        WHEN ije.transaction_affectation = 'delivery' OR ije.transaction_affectation = 'sweep' THEN 'S'
                        WHEN ije.transaction_affectation = 'devolution' THEN 'E'
                    END AS tipo_afectacion,
                    ije.product_internal_code AS codigo_producto,
                    'Frio' AS tipo_inventario,
                    ije.quantity AS cantidad,
                    ije.deficiency AS faltante,
                    ije.surplus AS sobrante,
                    ije.rejection AS rechazo,
                    ije.product_quota AS cupo,
                    ije.product_base_price AS precio_base,
                    ije.product_amount AS devolucion_fresco,
                    ije.product_cold_amount AS devolucion_frio,
                    CASE
                        WHEN je.status = 'process-success' THEN 'procesado'
                        WHEN je.status = 'processing' THEN 'trabajando'
                        WHEN je.status = 'process-failure' THEN 'error'
                        WHEN je.status = 'unprocessed' THEN 'sin-procesar'
                    END AS estatus
                FROM
                    journal_entry je
                INNER JOIN
                    inventory_journal_entry ije on je.id = ije.id
                WHERE
                    je.type = 'inventory-journal-entry'
                ORDER BY
                    je.id ASC;
            SQL;
        $this->addSql($sqlString);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP VIEW IF EXISTS v_poliza_inventarios;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
