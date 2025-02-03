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

final class Version20231117151549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update `sales_center_id` column from "DEFAULT NULL" to "NOT NULL" in `classification`, `concessionary_category_group`, `distribution` and `distribution_product` tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE classification CHANGE sales_center_id sales_center_id INT NOT NULL;');
        $this->addSql('ALTER TABLE concessionary_category_group CHANGE sales_center_id sales_center_id INT NOT NULL;');
        $this->addSql('ALTER TABLE distribution CHANGE sales_center_id sales_center_id INT NOT NULL;');
        $this->addSql('ALTER TABLE distribution_product CHANGE sales_center_id sales_center_id INT NOT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE classification CHANGE sales_center_id sales_center_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE concessionary_category_group CHANGE sales_center_id sales_center_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE distribution CHANGE sales_center_id sales_center_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE distribution_product CHANGE sales_center_id sales_center_id INT DEFAULT NULL;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
