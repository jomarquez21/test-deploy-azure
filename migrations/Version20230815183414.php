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

final class Version20230815183414 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Rename index and foreign keys for `participation`, `participations_concessionary_category_groups` and `participation_audit` tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE participation RENAME INDEX uniq_a4483781657cab3e TO UNIQ_AB55E24F657CAB3E;');
        $this->addSql('ALTER TABLE participations_concessionary_category_groups RENAME INDEX idx_c5c3c5a26eb6ddb5 TO IDX_41219926ACE3B73;');
        $this->addSql('ALTER TABLE participations_concessionary_category_groups RENAME INDEX uniq_c5c3c5a26af2744e TO UNIQ_41219926AF2744E;');
        $this->addSql('ALTER TABLE participation_audit RENAME INDEX rev_0d2391908c15a33bc5db061b64dd53b0_idx TO rev_bffb47833ba213e2cd362a0013254cd1_idx;');
        $this->addSql('ALTER TABLE participations_concessionary_category_groups_audit RENAME INDEX rev_621681d2b633572416c9ef802d2d8bbe_idx TO rev_c3327ebd91794bd3c978e6e59604bf7b_idx;');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_A4483781657CAB3E;');
        $this->addSql('ALTER TABLE participations_concessionary_category_groups DROP FOREIGN KEY FK_C5C3C5A26EB6DDB5;');
        $this->addSql('ALTER TABLE participations_concessionary_category_groups DROP FOREIGN KEY FK_C5C3C5A26AF2744E;');
        $this->addSql('ALTER TABLE participation_audit DROP FOREIGN KEY rev_0d2391908c15a33bc5db061b64dd53b0_fk;');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F657CAB3E FOREIGN KEY (sales_center_id) REFERENCES sales_center (id);');
        $this->addSql('ALTER TABLE participations_concessionary_category_groups ADD CONSTRAINT FK_41219926ACE3B73 FOREIGN KEY (participation_id) REFERENCES participation (id);');
        $this->addSql('ALTER TABLE participations_concessionary_category_groups ADD CONSTRAINT FK_41219926AF2744E FOREIGN KEY (concessionary_category_group_id) REFERENCES concessionary_category_group (id) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE participation_audit ADD CONSTRAINT rev_bffb47833ba213e2cd362a0013254cd1_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE participation RENAME INDEX uniq_ab55e24f657cab3e TO UNIQ_A4483781657CAB3E;');
        $this->addSql('ALTER TABLE participation_audit RENAME INDEX rev_bffb47833ba213e2cd362a0013254cd1_idx TO rev_0d2391908c15a33bc5db061b64dd53b0_idx;');
        $this->addSql('ALTER TABLE participations_concessionary_category_groups RENAME INDEX uniq_41219926af2744e TO UNIQ_C5C3C5A26AF2744E;');
        $this->addSql('ALTER TABLE participations_concessionary_category_groups RENAME INDEX idx_41219926ace3b73 TO IDX_C5C3C5A26EB6DDB5;');
        $this->addSql('ALTER TABLE participations_concessionary_category_groups_audit RENAME INDEX rev_c3327ebd91794bd3c978e6e59604bf7b_idx TO rev_621681d2b633572416c9ef802d2d8bbe_idx;');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F657CAB3E;');
        $this->addSql('ALTER TABLE participations_concessionary_category_groups DROP FOREIGN KEY FK_41219926ACE3B73;');
        $this->addSql('ALTER TABLE participations_concessionary_category_groups DROP FOREIGN KEY FK_41219926AF2744E;');
        $this->addSql('ALTER TABLE participation_audit DROP FOREIGN KEY rev_bffb47833ba213e2cd362a0013254cd1_fk;');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_A4483781657CAB3E FOREIGN KEY (sales_center_id) REFERENCES sales_center (id);');
        $this->addSql('ALTER TABLE participations_concessionary_category_groups ADD CONSTRAINT FK_C5C3C5A26EB6DDB5 FOREIGN KEY (participation_id) REFERENCES participation (id);');
        $this->addSql('ALTER TABLE participations_concessionary_category_groups ADD CONSTRAINT FK_C5C3C5A26AF2744E FOREIGN KEY (concessionary_category_group_id) REFERENCES concessionary_category_group (id) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE participation_audit ADD CONSTRAINT rev_0d2391908c15a33bc5db061b64dd53b0_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
