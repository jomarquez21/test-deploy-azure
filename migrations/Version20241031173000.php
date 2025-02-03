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

final class Version20241031173000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create view `v_catalogo_productos` to add multiple products with all required fields.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP VIEW IF EXISTS v_catalogo_productos;');

        $sqlString = <<<'SQL'
            CREATE VIEW v_catalogo_productos AS
            SELECT
                o.name AS organizacion_pais_id,
                p.internal_code AS codigo_interno,
                p.large_name AS nombre_largo,
                p.short_name AS nombre_corto,
                p.bar_code AS codigo_barras,
                b.code AS marca_codigo,
                b.name AS marca_nombre,
                pc.code AS categoria_codigo,
                pc.name AS categoria_nombre,
                p.key_sat AS clave_sat,
                p.unit_key AS clave_unidad,
                p.shelf_life AS vida_util,
                p.return_limit AS limite_devolucion,
                p.packaging_code AS codigo_empaque,
                p.packaging_capacity AS capacidad_empaque
             FROM
                product p
            LEFT JOIN
                brand b ON p.brand_id = b.id
            LEFT JOIN
                organization o ON p.organization_id = o.id
            LEFT JOIN
                product_category pc ON p.product_category_id = pc.id;
            SQL;

        $this->addSql($sqlString);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP VIEW IF EXISTS v_catalogo_productos;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
