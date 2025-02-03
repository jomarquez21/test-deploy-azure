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

final class Version20240913154830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add "automatic-jounral-entry-tline-modulo-de-frio@gbsupport.net" user and add `ROLE_API_AUTOMATIC_JOURNAL_ENTRIES_TLINE` API role group';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO `role_group` (`name`, `description`, `roles`, `created_at`, `is_editable`, `is_removable`) VALUES (\'Distribuidor de movimientos de póliza a TLINE\', \'Puede enviar movimientos de póliza a TLINE (API REST) por API REST\', \'[\"ROLE_API_AUTOMATIC_JOURNAL_ENTRIES_TLINE\"]\', NOW(), 0, 0);');
        $this->addSql(
            \sprintf(
                'INSERT INTO `user` (`username`, `password`, `locale`, `has_access_to_all_sales_centers`, `role_group_id`, `is_editable`, `is_removable`, `created_at`)'
                .' VALUES (\'%s\', \'%s\', \'%s\', %s, %s, %s, %s, NOW());',
                'automatic-jounral-entry-tline-modulo-de-frio@gbsupport.net',
                '$2y$13$J46u2VyWtxqEodORoSOxtuyULMF83H/5m86vlPy4GQ.zYpRmXCNFi',
                'es_MX',
                '1',
                '(SELECT `role_group`.`id` FROM `role_group` WHERE `role_group`.`name` = \'Distribuidor de movimientos de póliza a TLINE\' LIMIT 1)',
                0,
                0,
            )
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM `role_group` WHERE `name` = \'Distribuidor de movimientos de póliza a TLINE\';');
        $this->addSql(
            'DELETE FROM user WHERE `username` = \'automatic-jounral-entry-tline-modulo-de-frio@gbsupport.net\';'
        );
    }

    public function isTransactional(): bool
    {
        return true;
    }
}
