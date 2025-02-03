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

final class Version20230809015750 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `participation`, `concessionary_category_group` and `participations_concessionary_category_groups` tables and their auditory tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE concessionary_category_group (id INT AUTO_INCREMENT NOT NULL, concessionary_id INT NOT NULL, product_category_group_id INT NOT NULL, percentage INT DEFAULT 0 NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_1B94986E39BBA722 (concessionary_id), INDEX IDX_1B94986EFDAB6F6F (product_category_group_id), UNIQUE INDEX unique_concessionary_product_category_group_idx (concessionary_id, product_category_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE concessionary_category_group_audit (id INT NOT NULL, rev INT NOT NULL, concessionary_id INT DEFAULT NULL, product_category_group_id INT DEFAULT NULL, percentage INT DEFAULT 0, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', revtype VARCHAR(4) NOT NULL, INDEX rev_b482d9e86dbc48c156949a02613cba60_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE participation (id INT AUTO_INCREMENT NOT NULL, sales_center_id INT NOT NULL, reason VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_A4483781657CAB3E (sales_center_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE participations_concessionary_category_groups (participation_id INT NOT NULL, concessionary_category_group_id INT NOT NULL, INDEX IDX_C5C3C5A26EB6DDB5 (participation_id), UNIQUE INDEX UNIQ_C5C3C5A26AF2744E (concessionary_category_group_id), PRIMARY KEY(participation_id, concessionary_category_group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE participation_audit (id INT NOT NULL, rev INT NOT NULL, sales_center_id INT DEFAULT NULL, reason VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', revtype VARCHAR(4) NOT NULL, INDEX rev_0d2391908c15a33bc5db061b64dd53b0_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE participations_concessionary_category_groups_audit (participation_id INT NOT NULL, concessionary_category_group_id INT NOT NULL, rev INT NOT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_621681d2b633572416c9ef802d2d8bbe_idx (rev), PRIMARY KEY(participation_id, concessionary_category_group_id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE concessionary_category_group ADD CONSTRAINT FK_1B94986E39BBA722 FOREIGN KEY (concessionary_id) REFERENCES concessionary (id);');
        $this->addSql('ALTER TABLE concessionary_category_group ADD CONSTRAINT FK_1B94986EFDAB6F6F FOREIGN KEY (product_category_group_id) REFERENCES product_category_group (id);');
        $this->addSql('ALTER TABLE concessionary_category_group_audit ADD CONSTRAINT rev_b482d9e86dbc48c156949a02613cba60_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_A4483781657CAB3E FOREIGN KEY (sales_center_id) REFERENCES sales_center (id);');
        $this->addSql('ALTER TABLE participations_concessionary_category_groups ADD CONSTRAINT FK_C5C3C5A26EB6DDB5 FOREIGN KEY (participation_id) REFERENCES participation (id);');
        $this->addSql('ALTER TABLE participations_concessionary_category_groups ADD CONSTRAINT FK_C5C3C5A26AF2744E FOREIGN KEY (concessionary_category_group_id) REFERENCES concessionary_category_group (id) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE participation_audit ADD CONSTRAINT rev_0d2391908c15a33bc5db061b64dd53b0_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE concessionary_category_group DROP FOREIGN KEY FK_1B94986E39BBA722;');
        $this->addSql('ALTER TABLE concessionary_category_group DROP FOREIGN KEY FK_1B94986EFDAB6F6F;');
        $this->addSql('ALTER TABLE concessionary_category_group_audit DROP FOREIGN KEY rev_b482d9e86dbc48c156949a02613cba60_fk;');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_A4483781657CAB3E;');
        $this->addSql('ALTER TABLE participations_concessionary_category_groups DROP FOREIGN KEY FK_C5C3C5A26EB6DDB5;');
        $this->addSql('ALTER TABLE participations_concessionary_category_groups DROP FOREIGN KEY FK_C5C3C5A26AF2744E;');
        $this->addSql('ALTER TABLE participation_audit DROP FOREIGN KEY rev_0d2391908c15a33bc5db061b64dd53b0_fk;');
        $this->addSql('DROP TABLE concessionary_category_group;');
        $this->addSql('DROP TABLE concessionary_category_group_audit;');
        $this->addSql('DROP TABLE participation;');
        $this->addSql('DROP TABLE participations_concessionary_category_groups;');
        $this->addSql('DROP TABLE participation_audit;');
        $this->addSql('DROP TABLE participations_concessionary_category_groups_audit;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
