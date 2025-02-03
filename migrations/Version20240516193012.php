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

final class Version20240516193012 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add view to list product category group catalog with categories.';
    }

    public function up(Schema $schema): void
    {
        $sqlString = <<<'SQL'
            CREATE VIEW v_catalogo_grupo_categorias AS
                SELECT
                    product_category_group.name AS nombre,
                    GROUP_CONCAT(product_category.name SEPARATOR ',') AS categorias
                FROM
                    product_category_group
                INNER JOIN
                    product_category ON product_category_group.id = product_category.product_category_group_id
                GROUP BY
                    product_category_group.name;
            SQL;

        $this->addSql($sqlString);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP VIEW IF EXISTS v_catalogo_grupo_categorias;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
