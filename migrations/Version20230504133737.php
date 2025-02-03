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

final class Version20230504133737 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adds `town` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE town (id INT AUTO_INCREMENT NOT NULL, state_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_4CE6C7A45D83CC1 (state_id), UNIQUE INDEX unique_name_state_idx (name, state_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE town ADD CONSTRAINT FK_4CE6C7A45D83CC1 FOREIGN KEY (state_id) REFERENCES state (id);');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045575E23604 FOREIGN KEY (town_id) REFERENCES town (id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE town DROP CONSTRAINT FK_4CE6C7A45D83CC1;');
        $this->addSql('DROP TABLE town;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
