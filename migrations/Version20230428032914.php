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

final class Version20230428032914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adds `bank` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE bank (id INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_D860BF7A5E237E06 (name), INDEX IDX_D860BF7AF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE bank ADD CONSTRAINT FK_D860BF7AF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE bank;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
