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

final class Version20240524194430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add view to list percentage category by concessionary.';
    }

    public function up(Schema $schema): void
    {
        $sqlString = <<<'SQL'
            CREATE VIEW v_catalogo_porcentaje_concesionarios AS
                SELECT
                    sc.code AS codigo_ceve,
                    c.name AS concesionario,
                    pcg.name AS categoria,
                    ccg.percentage AS porcentaje,
                    ccg.updated_at AS ultima_actualizacion_utc
                FROM
                    concessionary_category_group ccg
                    INNER JOIN
                        sales_center sc on sc.id = ccg.sales_center_id
                    INNER JOIN
                        concessionary c on ccg.concessionary_id = c.id
                    INNER JOIN
                        product_category_group pcg on ccg.product_category_group_id = pcg.id;
            SQL;

        $this->addSql($sqlString);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP VIEW IF EXISTS v_catalogo_porcentaje_concesionarios;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
