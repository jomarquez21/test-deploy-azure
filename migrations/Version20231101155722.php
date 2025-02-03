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

final class Version20231101155722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insert base information.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO user (`email`, `roles`, `locale`, `password`, `created_at`) VALUES (\'admin@nubity.com\', \'["ROLE_ADMIN"]\', \'es_MX\', \'\$2y\$13\$t7SGauE8UxyTOqeREXlIG.UqZoldkvemepCllUEucJQ582d4Vy0qS\', NOW());');
        $this->addSql('INSERT INTO country (`name`, `iso3166Alpha2`, `created_at`) VALUES (\'México\', \'MX\', NOW());');
        $this->addSql('INSERT INTO devolution_system (`name`, `code`, `country_id`, `created_at`) VALUES (\'IV\', \'IV\', (SELECT `id` FROM country WHERE `iso3166Alpha2` = \'mx\'), NOW()), (\'IVY\', \'IVY\', (SELECT `id` FROM country WHERE `iso3166Alpha2` = \'mx\'), NOW());');
        $this->addSql('INSERT INTO price_list (`name`, `is_default`, `created_at`) VALUES (\'default\', 1, NOW()), (\'recovery\', 0, NOW()), (\'auction\', 0, NOW());');
        $this->addSql('INSERT INTO product_category_group (`name`, `is_default`, `created_at`) VALUES (\'Default\', 1, NOW());');
        $this->addSql('INSERT INTO tax (`name`, `percentage`, `created_at`) VALUES (\'iva\', 16, NOW()), (\'ieps\', 8, NOW());');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM user WHERE `email` = \'admin@nubity.com\';');
        $this->addSql('DELETE FROM country WHERE `iso3166Alpha2` = \'MX\';');
        $this->addSql('DELETE FROM devolution_system WHERE `code` IN (\'IV\', \'IVY\');');
        $this->addSql('DELETE FROM price_list WHERE `name` IN (\'default\', \'recovery\', \'auction\');');
        $this->addSql('DELETE FROM product_category_group WHERE `name` = \'Default\';');
        $this->addSql('DELETE FROM tax (`name`, `percentage`) WHERE `name` IN (\'iva\', \'ieps\');');
    }

    public function isTransactional(): bool
    {
        return true;
    }
}
