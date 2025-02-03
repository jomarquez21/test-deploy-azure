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

final class Version20240208150212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `DevolutionSystem::$role` property and rename `User::$email` to `User::$username`.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE devolution_system ADD role VARCHAR(255) DEFAULT NULL;');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user;');
        $this->addSql('ALTER TABLE user CHANGE email username VARCHAR(180) NOT NULL;');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username);');
        $this->addSql('ALTER TABLE user_audit CHANGE email username VARCHAR(180) DEFAULT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE devolution_system DROP role;');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON user;');
        $this->addSql('ALTER TABLE user CHANGE username email VARCHAR(180) NOT NULL;');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email);');
        $this->addSql('ALTER TABLE user_audit CHANGE username email VARCHAR(180) DEFAULT NULL;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
