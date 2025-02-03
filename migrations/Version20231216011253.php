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

final class Version20231216011253 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `sales_center_id` column in `journal_entry` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE journal_entry ADD sales_center_id INT NOT NULL;');
        $this->addSql('ALTER TABLE journal_entry ADD CONSTRAINT FK_C8FAAE5A657CAB3E FOREIGN KEY (sales_center_id) REFERENCES sales_center (id);');
        $this->addSql('CREATE INDEX IDX_C8FAAE5A657CAB3E ON journal_entry (sales_center_id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE journal_entry DROP FOREIGN KEY FK_C8FAAE5A657CAB3E;');
        $this->addSql('DROP INDEX IDX_C8FAAE5A657CAB3E ON journal_entry;');
        $this->addSql('ALTER TABLE journal_entry DROP sales_center_id;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
