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

final class Version20240103161714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `RoleGroup`.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE role_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, roles JSON DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_9A1CACEA5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE role_group_audit (id INT NOT NULL, rev INT NOT NULL, name VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, roles JSON DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', revtype VARCHAR(4) NOT NULL, INDEX rev_e0e40553563b58e9feee7276e8ce793e_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE role_group_audit ADD CONSTRAINT rev_e0e40553563b58e9feee7276e8ce793e_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('ALTER TABLE user ADD role_group_id INT DEFAULT NULL, DROP roles;');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D4873F76 FOREIGN KEY (role_group_id) REFERENCES role_group (id);');
        $this->addSql('CREATE INDEX IDX_8D93D649D4873F76 ON user (role_group_id);');
        $this->addSql('ALTER TABLE user_audit ADD role_group_id INT DEFAULT NULL, DROP roles;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE role_group;');
        $this->addSql('ALTER TABLE role_group_audit DROP FOREIGN KEY rev_e0e40553563b58e9feee7276e8ce793e_fk;');
        $this->addSql('DROP TABLE role_group_audit;');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D4873F76;');
        $this->addSql('DROP INDEX IDX_8D93D649D4873F76 ON user;');
        $this->addSql('ALTER TABLE user ADD roles JSON DEFAULT NULL, DROP role_group_id;');
        $this->addSql('ALTER TABLE user_audit ADD roles JSON DEFAULT NULL, DROP role_group_id;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
