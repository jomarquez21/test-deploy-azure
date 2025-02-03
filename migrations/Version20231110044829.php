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

final class Version20231110044829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add table `raw_client`.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE raw_client (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, data VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_5FA00C1519EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE raw_client ADD CONSTRAINT FK_5FA00C1519EB6921 FOREIGN KEY (client_id) REFERENCES client (id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE raw_client DROP FOREIGN KEY FK_5FA00C1519EB6921;');
        $this->addSql('DROP TABLE raw_client;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
