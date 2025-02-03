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

final class Version20240523163856 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add view to list classification items process.';
    }

    public function up(Schema $schema): void
    {
        $sqlString = <<<'SQL'
            CREATE VIEW v_proceso_clasificaciones AS
                SELECT
                    sc.code AS codigo_ceve,
                    cg.operation_reference AS fecha_proceso,
                    p.internal_code AS item,
                    c.quantity AS devolucion,
                    c.quantity_auction AS remate,
                    c.quantity_concessionary AS recuperacion,
                    c.quantity_sweep AS barredura

                FROM
                    classification c
                INNER JOIN
                    classification_group cg on c.classification_group_id = cg.id
                INNER JOIN
                    sales_center sc on c.sales_center_id = sc.id
                INNER JOIN
                    product p on c.product_id = p.id;
            SQL;
        $this->addSql($sqlString);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP VIEW IF EXISTS v_proceso_clasificaciones;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
