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

final class Version20231110025829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `due_at` column to `promissory_note` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE promissory_note ADD due_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\';');
        $this->addSql('ALTER TABLE promissory_note_audit ADD due_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\';');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE promissory_note DROP due_at;');
        $this->addSql('ALTER TABLE promissory_note_audit DROP due_at;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
