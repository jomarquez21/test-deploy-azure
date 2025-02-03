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

final class Version20231121174439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `classification_group_id` and `operation_reference` columns in `distribution` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE distribution CHANGE classification_group_id classification_group_id INT NOT NULL;');
        $this->addSql('ALTER TABLE distribution ADD CONSTRAINT FK_A44837817BC2BA17 FOREIGN KEY (classification_group_id) REFERENCES classification_group (id);');
        $this->addSql('CREATE INDEX IDX_A44837817BC2BA17 ON distribution (classification_group_id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE distribution DROP FOREIGN KEY FK_A44837817BC2BA17;');
        $this->addSql('DROP INDEX IDX_A44837817BC2BA17 ON distribution;');
        $this->addSql('ALTER TABLE distribution CHANGE classification_group_id classification_group_id DEFAULT NOT NULL;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
