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

final class Version20240208150213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add role groups and users for "IV" and "IVY" devolution systems.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            \sprintf(
                'INSERT INTO `role_group` (`name`, `description`, `roles`, `created_at`, `is_editable`, `is_removable`)'
                .' VALUES (\'%s\', \'%s\', \'%s\', NOW(), 0, 0);',
                'Sistema de devolución IV (API REST)',
                'Puede enviar devoluciones en nombre del sistema de devolución IV por API REST',
                '[\"ROLE_API_DEVOLUTION_SYSTEM_IV\"]',
            )
        );

        $this->addSql(
            \sprintf(
                'INSERT INTO `role_group` (`name`, `description`, `roles`, `created_at`, `is_editable`, `is_removable`)'
                .' VALUES (\'%s\', \'%s\', \'%s\', NOW(), 0, 0);',
                'Sistema de devolución IVY (API REST)',
                'Puede enviar devoluciones en nombre del sistema de devolución IVY por API REST',
                '[\"ROLE_API_DEVOLUTION_SYSTEM_IVY\"]',
            )
        );

        $this->addSql(
            \sprintf(
                'INSERT INTO `user` (`username`, `password`, `locale`, `has_access_to_all_sales_centers`, `role_group_id`, `is_editable`, `is_removable`, `created_at`)'
                .' VALUES (\'%s\', \'%s\', \'%s\', %s, %s, %s, %s, NOW());',
                'user-iv',
                '$2y$13$Ig5sIdkxmZPTtH.6Vs4smOmZ6BE.NHJDoOpbpGxd.4t0Q1sdf9Kl.',
                'es_MX',
                '1',
                '(SELECT `role_group`.`id` FROM `role_group` WHERE `role_group`.`name` = \'Sistema de devolución IV (API REST)\' LIMIT 1)',
                0,
                0,
            )
        );

        $this->addSql(
            \sprintf(
                'INSERT INTO `user` (`username`, `password`, `locale`, `has_access_to_all_sales_centers`, `role_group_id`, `is_editable`, `is_removable`, `created_at`)'
                .' VALUES (\'%s\', \'%s\', \'%s\', %s, %s, %s, %s, NOW());',
                'user-ivy',
                '$2y$13$NnrtIlAkosQhG3l2/EmEcezFmUjGIRplgwpQSNlwfSRBiqBOlMSqK',
                'es_MX',
                '1',
                '(SELECT `role_group`.`id` FROM `role_group` WHERE `role_group`.`name` = \'Sistema de devolución IVY (API REST)\' LIMIT 1)',
                0,
                0,
            )
        );

        $this->addSql('UPDATE devolution_system SET role = \'ROLE_API_DEVOLUTION_SYSTEM_IV\' WHERE code = \'IV\';');
        $this->addSql('UPDATE devolution_system SET role = \'ROLE_API_DEVOLUTION_SYSTEM_IVY\' WHERE code = \'IVY\';');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('UPDATE devolution_system SET role = NULL WHERE code IN (\'IV\', \'IVY\') ;');
        $this->addSql('DELETE FROM user WHERE `name` IN (\'user-ivy\', \'user-ivy\');');
        $this->addSql('DELETE FROM role_group WHERE `name` IN (\'Sistema de devolución IV (API REST)\', \'Sistema de devolución IVY (API REST)\');');
    }

    public function isTransactional(): bool
    {
        return true;
    }
}
