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

final class Version20241003200946 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add "dayOfWeek" field to create percentage every day of week Bimbo.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP INDEX unique_concessionary_product_category_group_idx ON concessionary_category_group;');
        $this->addSql('ALTER TABLE concessionary_category_group ADD day_of_week INT DEFAULT 5 NOT NULL COMMENT \'The number of the day of the week is stored. Where the week starts at 1.\';');
        $this->addSql('CREATE UNIQUE INDEX unique_concessionary_product_category_group_idx ON concessionary_category_group (concessionary_id, product_category_group_id, day_of_week);');
        $this->addSql('ALTER TABLE concessionary_category_group_audit ADD day_of_week INT DEFAULT 5 COMMENT \'The number of the day of the week is stored. Where the week starts at 1.\';');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX unique_concessionary_product_category_group_idx ON concessionary_category_group;');
        $this->addSql('ALTER TABLE concessionary_category_group DROP day_of_week;');
        $this->addSql('CREATE UNIQUE INDEX unique_concessionary_product_category_group_idx ON concessionary_category_group (concessionary_id, product_category_group_id);');
        $this->addSql('ALTER TABLE concessionary_category_group_audit DROP day_of_week;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
