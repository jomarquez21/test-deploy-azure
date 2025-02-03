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

final class Version20240618185911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add field "impuesto" to view v_poliza_factura.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP VIEW IF EXISTS v_poliza_facturas;');

        $sqlString = <<<'SQL'
            CREATE VIEW v_poliza_facturas AS
                SELECT
                    je.sales_center_code AS codigo_ceve,
                    je.operation_date_reference AS fecha_operacion_transaccion,
                    je.source_system AS sistema_origen,
                    je.country_code AS codigo_pais,
                    je.organization_legal_code AS entidad_legal,
                    je.route_identifier AS identificador_ruta,
                    je.layout_version AS version_layout,
                    je.cost_center_code AS centro_costos,
                    invje.lines_number AS numero_lineas,
                    invje.invoice_folio AS folio,
                    invje.signed_at_reference AS fecha_del_documento,
                    invje.credit_days AS dias_de_credito,
                    invje.product_internal_code AS codigo_producto,
                    invje.product_sold_quantity AS cantidad_venta,
                    invje.product_sold_price AS precio_venta,
                    invje.product_sold_cost AS precio_costo,
                    invje.product_sold_price_difference AS diferencia_precio,
                    invje.tax_amount AS impuesto,
                    invje.promotion_Amount AS promocion_pactada,
                    invje.confidential_discount_amount AS descuento_confidencial,
                    invje.product_sold_amount AS monto_linea,
                    invje.product_description AS descripcion_servicio,
                    invje.product_category AS categoria,
                    invje.client_party_number AS codigo_cliente,
                    invje.client_name AS nombre_cliente,
                    invje.tax_code AS codigo_impuesto,
                    invje.tax_percentage AS tasa_impuesto,
                    invje.payment_type AS forma_pago,
                    invje.invoice_uuid AS UUID,
                    CASE
                        WHEN je.status = 'process-success' THEN 'procesado'
                        WHEN je.status = 'processing' THEN 'trabajando'
                        WHEN je.status = 'process-failure' THEN 'error'
                        WHEN je.status = 'unprocessed' THEN 'sin-procesar'
                    END AS estatus
                FROM
                    journal_entry je
                INNER JOIN
                    invoice_journal_entry invje on je.id = invje.id
                WHERE
                    je.type = 'invoice-journal-entry'
                ORDER BY
                    je.id ASC;
            SQL;
        $this->addSql($sqlString);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP VIEW IF EXISTS v_poliza_facturas;');

        $sqlString = <<<'SQL'
            CREATE VIEW v_poliza_facturas AS
                SELECT
                    je.sales_center_code AS codigo_ceve,
                    je.operation_date_reference AS fecha_operacion_transaccion,
                    je.source_system AS sistema_origen,
                    je.country_code AS codigo_pais,
                    je.organization_legal_code AS entidad_legal,
                    je.route_identifier AS identificador_ruta,
                    je.layout_version AS version_layout,
                    je.cost_center_code AS centro_costos,
                    invje.lines_number AS numero_lineas,
                    invje.invoice_folio AS folio,
                    invje.signed_at_reference AS fecha_del_documento,
                    invje.credit_days AS dias_de_credito,
                    invje.product_internal_code AS codigo_producto,
                    invje.product_sold_quantity AS cantidad_venta,
                    invje.product_sold_price AS precio_venta,
                    invje.product_sold_cost AS precio_costo,
                    invje.product_sold_price_difference AS diferencia_precio,
                    invje.promotion_Amount AS promocion_pactada,
                    invje.confidential_discount_amount AS descuento_confidencial,
                    invje.product_sold_amount AS monto_linea,
                    invje.product_description AS descripcion_servicio,
                    invje.product_category AS categoria,
                    invje.client_party_number AS codigo_cliente,
                    invje.client_name AS nombre_cliente,
                    invje.tax_code AS codigo_impuesto,
                    invje.tax_percentage AS tasa_impuesto,
                    invje.payment_type AS forma_pago,
                    invje.invoice_uuid AS UUID,
                    CASE
                        WHEN je.status = 'process-success' THEN 'procesado'
                        WHEN je.status = 'processing' THEN 'trabajando'
                        WHEN je.status = 'process-failure' THEN 'error'
                        WHEN je.status = 'unprocessed' THEN 'sin-procesar'
                    END AS estatus
                FROM
                    journal_entry je
                INNER JOIN
                    invoice_journal_entry invje on je.id = invje.id
                WHERE
                    je.type = 'invoice-journal-entry'
                ORDER BY
                    je.id ASC;
            SQL;
        $this->addSql($sqlString);
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
