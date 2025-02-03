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

final class Version20231003155044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update `promissory_note` table and add relationship in `distribution` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE distribution ADD promissory_note_id INT DEFAULT NULL, ADD target_distribution_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE distribution ADD CONSTRAINT FK_A44837813B169F50 FOREIGN KEY (promissory_note_id) REFERENCES promissory_note (id);');
        $this->addSql('ALTER TABLE distribution ADD CONSTRAINT FK_A44837812CB83FD6 FOREIGN KEY (target_distribution_id) REFERENCES distribution (id);');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A44837813B169F50 ON distribution (promissory_note_id);');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A44837812CB83FD6 ON distribution (target_distribution_id);');
        $this->addSql('ALTER TABLE distribution_audit ADD promissory_note_id INT DEFAULT NULL, ADD target_distribution_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE promissory_note CHANGE status status ENUM(\'uncollectible\', \'current\', \'paid\');');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE distribution DROP FOREIGN KEY FK_A44837813B169F50;');
        $this->addSql('ALTER TABLE distribution DROP FOREIGN KEY FK_A44837812CB83FD6;');
        $this->addSql('DROP INDEX UNIQ_A44837813B169F50 ON distribution;');
        $this->addSql('DROP INDEX UNIQ_A44837812CB83FD6 ON distribution;');
        $this->addSql('ALTER TABLE distribution DROP promissory_note_id, DROP target_distribution_id, CHANGE status status VARCHAR(255) DEFAULT NULL;');
        $this->addSql('ALTER TABLE distribution_audit DROP promissory_note_id, DROP target_distribution_id;');
        $this->addSql('ALTER TABLE promissory_note CHANGE status status VARCHAR(255) DEFAULT NULL;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
