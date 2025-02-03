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

final class Version20240110172347 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add users.';
    }

    public function up(Schema $schema): void
    {
        foreach ($this->getUsers() as $email => $data) {
            $this->addSql(
                \sprintf(
                    'INSERT INTO `user` (`email`, `password`, `locale`, `has_access_to_all_sales_centers`, `role_group_id`, `is_editable`, `is_removable`, `created_at`) VALUES (\'%s\', \'%s\', \'%s\', %s, %s, %s, %s, NOW());',
                    $email,
                    $data['password'],
                    $data['locale'],
                    $data['has_access_to_all_sales_centers'],
                    $data['role_group_id'],
                    $data['is_editable'],
                    $data['is_removable'],
                )
            );
        }
    }

    public function down(Schema $schema): void
    {
        foreach ($this->getUsers() as $email => $data) {
            $this->addSql(\sprintf('DELETE FROM user WHERE `email` = \'%s\';', $email));
        }
    }

    public function isTransactional(): bool
    {
        return true;
    }

    /**
     * @phpstan-return iterable<string, array{
     *  password: string,
     *  locale: string,
     *  has_access_to_all_sales_centers: int,
     *  role_group_id: string,
     *  is_editable: int,
     *  is_removable: int,
     * }>
     */
    private function getUsers(): iterable
    {
        yield 'leopoldo.huesca@gbsupport.net' => [
            'password' => '$2y$13$OQnfpWr3mV69dVoNTAp43exfvphrDW/5A7.mqbzkpZCZx/jlUTTh6',
            'locale' => 'es_MX',
            'has_access_to_all_sales_centers' => 1,
            'role_group_id' => '(SELECT `role_group`.`id` FROM `role_group` WHERE `role_group`.`name` = \'Super admin\' LIMIT 1)',
            'is_editable' => 1,
            'is_removable' => 1,
        ];

        yield 'accounting-modulo-de-frio@gbsupport.net' => [
            'password' => '$2y$13$zNuJqrbhxUoH84UbtqMv1.rLwx.gS6j9bF704zJWYT9HyBw77/VNa',
            'locale' => 'es_MX',
            'has_access_to_all_sales_centers' => 1,
            'role_group_id' => '(SELECT `role_group`.`id` FROM `role_group` WHERE `role_group`.`name` = \'Creador de asientos contables (API REST)\' LIMIT 1)',
            'is_editable' => 0,
            'is_removable' => 0,
        ];

        yield 'billing-modulo-de-frio@gbsupport.net' => [
            'password' => '$2y$13$QGEtzmrcGEw.nj3NgMzJT.GHtcewVVGOeLX18KePM4xiHVy4lkbYu',
            'locale' => 'es_MX',
            'has_access_to_all_sales_centers' => 1,
            'role_group_id' => '(SELECT `role_group`.`id` FROM `role_group` WHERE `role_group`.`name` = \'Timbrador de facturas (API REST)\' LIMIT 1)',
            'is_editable' => 0,
            'is_removable' => 0,
        ];

        yield 'customer-catalog-modulo-de-frio@gbsupport.net' => [
            'password' => '$2y$13$J9tIA9QIfDDVgdUbivY.eucuH9oVU.Y8tRUfMMDYvq0DueqdEUq6G',
            'locale' => 'es_MX',
            'has_access_to_all_sales_centers' => 1,
            'role_group_id' => '(SELECT `role_group`.`id` FROM `role_group` WHERE `role_group`.`name` = \'Sincronizador de catálogo de clientes (API REST)\' LIMIT 1)',
            'is_editable' => 0,
            'is_removable' => 0,
        ];

        yield 'product-catalog-modulo-de-frio@gbsupport.net' => [
            'password' => '$2y$13$dQKL/nfKLSqU6UOJ0Oj6DuY8TN.EgnC8o7InX8gTRa8ZcpRVfpyVu',
            'locale' => 'es_MX',
            'has_access_to_all_sales_centers' => 1,
            'role_group_id' => '(SELECT `role_group`.`id` FROM `role_group` WHERE `role_group`.`name` = \'Sincronizador de catálogo de productos (API REST)\' LIMIT 1)',
            'is_editable' => 0,
            'is_removable' => 0,
        ];

        yield 'automatic-sweep-modulo-de-frio@gbsupport.net' => [
            'password' => '$2y$13$sEypXjpRAXMawitnrzoO8erCPrY2jRD2PVi.nj74LNzxr8J3Hq9V6',
            'locale' => 'es_MX',
            'has_access_to_all_sales_centers' => 1,
            'role_group_id' => '(SELECT `role_group`.`id` FROM `role_group` WHERE `role_group`.`name` = \'Barredor automático (API REST)\' LIMIT 1)',
            'is_editable' => 0,
            'is_removable' => 0,
        ];
    }
}
