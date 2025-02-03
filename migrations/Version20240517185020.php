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

final class Version20240517185020 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add view to list devolution returns process.';
    }

    public function up(Schema $schema): void
    {
        $sqlString = <<<'SQL'
            CREATE VIEW v_proceso_devoluciones AS
                SELECT
                    sc.code AS codigo_ceve,
                    ds.code AS sistema,
                    ds.name AS sistema_nombre,
                    p.internal_code AS item,
                    dsp.quantity AS cantidad,
                    dr.devolution_reference AS fecha_devolucion,
                    cg.operation_reference AS fecha_proceso
                FROM
                    devolution_return dr
                INNER JOIN
                        sales_center sc ON dr.sales_center_id = sc.id
                INNER JOIN
                        devolution_system ds ON dr.devolution_system_id = ds.id
                INNER JOIN
                        devolution_system_product dsp ON dr.id = dsp.devolution_return_id
                INNER JOIN
                        product p ON dsp.product_id = p.id
                LEFT JOIN
                        classification_group cg ON
                            dr.classification_group_id = cg.id AND dr.sales_center_id = cg.sales_center_id;
            SQL;

        $this->addSql($sqlString);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP VIEW IF EXISTS v_proceso_devoluciones;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
