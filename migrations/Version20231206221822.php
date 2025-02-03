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

final class Version20231206221822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `type` column and `base_target_distribution_id in `distribution` table and add `target_promissory_note_id` column in `promissory_note` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE distribution ADD base_target_distribution_id INT DEFAULT NULL, ADD type ENUM(\'complementary\', \'normal\');');
        $this->addSql('ALTER TABLE distribution ADD CONSTRAINT FK_A4483781D5C399E6 FOREIGN KEY (base_target_distribution_id) REFERENCES distribution (id);');
        $this->addSql('CREATE INDEX IDX_A4483781D5C399E6 ON distribution (base_target_distribution_id);');
        $this->addSql('ALTER TABLE distribution_audit ADD base_target_distribution_id INT DEFAULT NULL, ADD type ENUM(\'complementary\', \'normal\');');
        $this->addSql('ALTER TABLE promissory_note ADD target_promissory_note_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE promissory_note ADD CONSTRAINT FK_B092F716FA775602 FOREIGN KEY (target_promissory_note_id) REFERENCES promissory_note (id);');
        $this->addSql('CREATE INDEX IDX_B092F716FA775602 ON promissory_note (target_promissory_note_id);');
        $this->addSql('ALTER TABLE promissory_note_audit ADD target_promissory_note_id INT DEFAULT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE distribution DROP FOREIGN KEY FK_A4483781D5C399E6;');
        $this->addSql('DROP INDEX IDX_A4483781D5C399E6 ON distribution;');
        $this->addSql('ALTER TABLE distribution DROP base_target_distribution_id, DROP type;');
        $this->addSql('ALTER TABLE distribution_audit DROP base_target_distribution_id;');
        $this->addSql('ALTER TABLE promissory_note DROP FOREIGN KEY FK_B092F716FA775602;');
        $this->addSql('DROP INDEX IDX_B092F716FA775602 ON promissory_note;');
        $this->addSql('ALTER TABLE promissory_note DROP target_promissory_note_id;');
        $this->addSql('ALTER TABLE promissory_note_audit DROP target_promissory_note_id;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
