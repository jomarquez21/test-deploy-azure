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

final class Version20240110172346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Make "Super admin" role group not removable and not editable, add role groups for API REST.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE `role_group` SET `is_editable` = 0, `is_removable` = 0 WHERE name = \'Super admin\';');
        $this->addSql('INSERT INTO `role_group` (`name`, `description`, `roles`, `created_at`, `is_editable`, `is_removable`) VALUES (\'Creador de asientos contables (API REST)\', \'Puede agregar registros contables por API REST\', \'[\"ROLE_API_ADD_ACCOUNTING_TRANSACTION\"]\', NOW(), 0, 0);');
        $this->addSql('INSERT INTO `role_group` (`name`, `description`, `roles`, `created_at`, `is_editable`, `is_removable`) VALUES (\'Timbrador de facturas (API REST)\', \'Puede timbrar facturas por API REST\', \'[\"ROLE_API_SIGN_INVOICE\"]\', NOW(), 0, 0);');
        $this->addSql('INSERT INTO `role_group` (`name`, `description`, `roles`, `created_at`, `is_editable`, `is_removable`) VALUES (\'Sincronizador de catálogo de clientes (API REST)\', \'Puede sincronizar el catálogo de clientes por API REST\', \'[\"ROLE_API_SYNCHRONIZE_CUSTOMER_CATALOG\"]\', NOW(), 0, 0);');
        $this->addSql('INSERT INTO `role_group` (`name`, `description`, `roles`, `created_at`, `is_editable`, `is_removable`) VALUES (\'Sincronizador de catálogo de productos (API REST)\', \'Puede sincronizar el catálogo de productos por API REST\', \'[\"ROLE_API_SYNCHRONIZE_PRODUCT_CATALOG\"]\', NOW(), 0, 0);');
        $this->addSql('INSERT INTO `role_group` (`name`, `description`, `roles`, `created_at`, `is_editable`, `is_removable`) VALUES (\'Barredor automático (API REST)\', \'Puede enviar devoluciones a barredura automáticamente por API REST\', \'[\"ROLE_API_AUTOMATIC_SWEEP\"]\', NOW(), 0, 0);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('UPDATE `role_group` SET `is_editable` = 1, `is_removable` = 1 WHERE name = \'Super admin\';');
        $this->addSql('DELETE FROM `role_group` WHERE `name` IN (\'Creador de asientos contables (API REST)\', \'Timbrador de facturas (API REST)\', \'Sincronizador de catálogo de clientes (API REST)\', \'Sincronizador de catálogo de productos (API REST)\', \'Barredor automático (API REST)\');');
    }

    public function isTransactional(): bool
    {
        return true;
    }
}
