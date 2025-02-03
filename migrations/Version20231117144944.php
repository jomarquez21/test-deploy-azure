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

final class Version20231117144944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update `sales_center_id` value in `classification`, `concessionary_category_group`, `distribution` and `distribution_product` tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE classification INNER JOIN classification_group ON classification.classification_group_id = classification_group.id SET classification.sales_center_id = classification_group.sales_center_id;');
        $this->addSql('UPDATE concessionary_category_group INNER JOIN concessionary ON concessionary_category_group.concessionary_id = concessionary.id SET concessionary_category_group.sales_center_id = concessionary.sales_center_id;');
        $this->addSql('UPDATE distribution INNER JOIN concessionary ON distribution.concessionary_id = concessionary.id SET distribution.sales_center_id = concessionary.sales_center_id;');
        $this->addSql('UPDATE distribution_product INNER JOIN concessionary ON distribution_product.concessionary_id = concessionary.id SET distribution_product.sales_center_id = concessionary.sales_center_id;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('UPDATE classification INNER JOIN classification_group ON classification.classification_group_id = classification_group.id SET classification.sales_center_id = NULL;');
        $this->addSql('UPDATE concessionary_category_group INNER JOIN concessionary ON concessionary_category_group.concessionary_id = concessionary.id SET concessionary_category_group.sales_center_id = NULL;');
        $this->addSql('UPDATE distribution INNER JOIN concessionary ON distribution.concessionary_id = concessionary.id SET distribution.sales_center_id = NULL;');
        $this->addSql('UPDATE distribution_product INNER JOIN concessionary ON distribution_product.concessionary_id = concessionary.id SET distribution_product.sales_center_id = NULL;');
    }

    public function isTransactional(): bool
    {
        return true;
    }
}
