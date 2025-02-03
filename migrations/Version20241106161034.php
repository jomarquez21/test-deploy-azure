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

final class Version20241106161034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add new role to "Super admin".';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE `role_group` SET  `role_group`.`roles` = \'[\"ROLE_ADMIN_COUNTRY_ALL\", \"ROLE_ADMIN_STATE_ALL\", \"ROLE_ADMIN_MUNICIPALITY_ALL\", \"ROLE_ADMIN_TOWN_ALL\", \"ROLE_ADMIN_ORGANIZATION_ALL\", \"ROLE_ADMIN_BANK_ALL\", \"ROLE_ADMIN_SALES_CENTER_ALL\", \"ROLE_ADMIN_CLIENT_ALL\", \"ROLE_ADMIN_PRODUCT_ALL\", \"ROLE_ADMIN_CONCESSIONARY_ALL\", \"ROLE_ADMIN_PRODUCT_CATEGORY_ALL\", \"ROLE_ADMIN_PRODUCT_CATEGORY_GROUP_ALL\", \"ROLE_ADMIN_PARTICIPATION_ALL\", \"ROLE_ADMIN_CLASSIFICATION_GROUP_ALL\", \"ROLE_ADMIN_DISTRIBUTION_REASSIGN_ALL\", \"ROLE_ADMIN_DISTRIBUTION_DELIVERY_ALL\", \"ROLE_ADMIN_CONCESSIONARY_PARTICIPATION_ALL\", \"ROLE_ADMIN_SWEEP_ALL\", \"ROLE_ADMIN_PROMISSORY_NOTE_ALL\", \"ROLE_ADMIN_HISTORICAL_PAYMENT_REGISTRY_ALL\", \"ROLE_ADMIN_JOURNAL_ENTRY_ALL\", \"ROLE_SONATA_USER_ADMIN_USER_ALL\", \"ROLE_ADMIN_ROLE_GROUP_ALL\", \"ROLE_ADMIN_CONCESSIONARY_IS_UNCOLLECTIBLE\",\"ROLE_ADMIN_UPLOAD_DEVOLUTION_RETURN_BY_PLAN_B\"]\' WHERE `role_group`.`name` = \'Super admin\' LIMIT 1;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('UPDATE `role_group` SET  `role_group`.`roles` = \'[\"ROLE_ADMIN_COUNTRY_ALL\", \"ROLE_ADMIN_STATE_ALL\", \"ROLE_ADMIN_MUNICIPALITY_ALL\", \"ROLE_ADMIN_TOWN_ALL\", \"ROLE_ADMIN_ORGANIZATION_ALL\", \"ROLE_ADMIN_BANK_ALL\", \"ROLE_ADMIN_SALES_CENTER_ALL\", \"ROLE_ADMIN_CLIENT_ALL\", \"ROLE_ADMIN_PRODUCT_ALL\", \"ROLE_ADMIN_CONCESSIONARY_ALL\", \"ROLE_ADMIN_PRODUCT_CATEGORY_ALL\", \"ROLE_ADMIN_PRODUCT_CATEGORY_GROUP_ALL\", \"ROLE_ADMIN_PARTICIPATION_ALL\", \"ROLE_ADMIN_CLASSIFICATION_GROUP_ALL\", \"ROLE_ADMIN_DISTRIBUTION_REASSIGN_ALL\", \"ROLE_ADMIN_DISTRIBUTION_DELIVERY_ALL\", \"ROLE_ADMIN_CONCESSIONARY_PARTICIPATION_ALL\", \"ROLE_ADMIN_SWEEP_ALL\", \"ROLE_ADMIN_PROMISSORY_NOTE_ALL\", \"ROLE_ADMIN_HISTORICAL_PAYMENT_REGISTRY_ALL\", \"ROLE_ADMIN_JOURNAL_ENTRY_ALL\", \"ROLE_SONATA_USER_ADMIN_USER_ALL\", \"ROLE_ADMIN_ROLE_GROUP_ALL\", \"ROLE_ADMIN_CONCESSIONARY_IS_UNCOLLECTIBLE\"]\' WHERE `role_group`.`name` = \'Super admin\' LIMIT 1;');
    }

    public function isTransactional(): bool
    {
        return true;
    }
}
