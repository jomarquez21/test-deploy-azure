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

final class Version20230511001134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adds `citizenMx` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE citizen_mx (id INT AUTO_INCREMENT NOT NULL, state_id INT NOT NULL, town_id INT NOT NULL, concessionary_id INT NOT NULL, fullname VARCHAR(255) NOT NULL, birthdate DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', gender VARCHAR(255) NOT NULL, external_number VARCHAR(255) NOT NULL, internal_number VARCHAR(255) NOT NULL, colony VARCHAR(255) NOT NULL, zip_code VARCHAR(255) NOT NULL, voter_key VARCHAR(255) NOT NULL, population_id VARCHAR(255) NOT NULL, tax_register VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_D651A5655D83CC1 (state_id), INDEX IDX_D651A56575E23604 (town_id), INDEX IDX_D651A56539BBA722 (concessionary_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE citizen_mx ADD CONSTRAINT FK_D651A5655D83CC1 FOREIGN KEY (state_id) REFERENCES state (id);');
        $this->addSql('ALTER TABLE citizen_mx ADD CONSTRAINT FK_D651A56575E23604 FOREIGN KEY (town_id) REFERENCES town (id);');
        $this->addSql('ALTER TABLE citizen_mx ADD CONSTRAINT FK_D651A56539BBA722 FOREIGN KEY (concessionary_id) REFERENCES concessionary (id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE citizen_mx;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
