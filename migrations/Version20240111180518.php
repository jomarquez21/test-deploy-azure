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

final class Version20240111180518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Raname `town` table to `colony` table and its relationships with `citizen`, `organization` and `sales_center` tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE citizen DROP FOREIGN KEY FK_A953172975E23604;');
        $this->addSql('ALTER TABLE organization DROP FOREIGN KEY FK_C1EE637C75E23604;');
        $this->addSql('ALTER TABLE sales_center DROP FOREIGN KEY FK_6204B92C75E23604;');
        $this->addSql('ALTER TABLE town DROP FOREIGN KEY FK_4CE6C7A4AE6F181C;');
        $this->addSql('ALTER TABLE town_audit DROP FOREIGN KEY rev_72661e479ae07396c63c0cdfc3146739_fk;');
        $this->addSql('ALTER TABLE town RENAME colony;');
        $this->addSql('ALTER TABLE town_audit RENAME colony_audit;');
        $this->addSql('ALTER TABLE colony ADD CONSTRAINT FK_C41C77DCAE6F181C FOREIGN KEY (municipality_id) REFERENCES municipality (id);');
        $this->addSql('ALTER TABLE colony_audit ADD CONSTRAINT rev_ee99fa95281ea365f41f4da618942f40_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('DROP INDEX IDX_A953172975E23604 ON citizen;');
        $this->addSql('ALTER TABLE citizen CHANGE town_id colony_id INT DEFAULT NULL, CHANGE colony town VARCHAR(255) DEFAULT NULL;');
        $this->addSql('ALTER TABLE citizen ADD CONSTRAINT FK_A953172996ADBADE FOREIGN KEY (colony_id) REFERENCES colony (id);');
        $this->addSql('CREATE INDEX IDX_A953172996ADBADE ON citizen (colony_id);');
        $this->addSql('ALTER TABLE citizen_audit CHANGE town_id colony_id INT DEFAULT NULL, CHANGE colony town VARCHAR(255) DEFAULT NULL;');
        $this->addSql('DROP INDEX IDX_C1EE637C75E23604 ON organization;');
        $this->addSql('ALTER TABLE organization CHANGE town_id colony_id INT DEFAULT NULL, CHANGE colony town VARCHAR(255) DEFAULT NULL;');
        $this->addSql('ALTER TABLE organization ADD CONSTRAINT FK_C1EE637C96ADBADE FOREIGN KEY (colony_id) REFERENCES colony (id);');
        $this->addSql('CREATE INDEX IDX_C1EE637C96ADBADE ON organization (colony_id);');
        $this->addSql('ALTER TABLE organization_audit CHANGE town_id colony_id INT DEFAULT NULL, CHANGE colony town VARCHAR(255) DEFAULT NULL;');
        $this->addSql('DROP INDEX IDX_6204B92C75E23604 ON sales_center;');
        $this->addSql('ALTER TABLE sales_center CHANGE town_id colony_id INT DEFAULT NULL, CHANGE colony town VARCHAR(255) DEFAULT NULL;');
        $this->addSql('ALTER TABLE sales_center ADD CONSTRAINT FK_6204B92C96ADBADE FOREIGN KEY (colony_id) REFERENCES colony (id);');
        $this->addSql('CREATE INDEX IDX_6204B92C96ADBADE ON sales_center (colony_id);');
        $this->addSql('ALTER TABLE sales_center_audit CHANGE town_id colony_id INT DEFAULT NULL, CHANGE colony town VARCHAR(255) DEFAULT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE citizen DROP FOREIGN KEY FK_A953172996ADBADE;');
        $this->addSql('ALTER TABLE organization DROP FOREIGN KEY FK_C1EE637C96ADBADE;');
        $this->addSql('ALTER TABLE sales_center DROP FOREIGN KEY FK_6204B92C96ADBADE;');
        $this->addSql('ALTER TABLE colony DROP FOREIGN KEY FK_C41C77DCAE6F181C;');
        $this->addSql('ALTER TABLE colony_audit DROP FOREIGN KEY rev_ee99fa95281ea365f41f4da618942f40_fk;');
        $this->addSql('ALTER TABLE colony RENAME town;');
        $this->addSql('ALTER TABLE colony_audit RENAME town_audit;');
        $this->addSql('ALTER TABLE town ADD CONSTRAINT FK_4CE6C7A4AE6F181C FOREIGN KEY (municipality_id) REFERENCES municipality (id) ON UPDATE NO ACTION ON DELETE NO ACTION;');
        $this->addSql('ALTER TABLE town_audit ADD CONSTRAINT rev_72661e479ae07396c63c0cdfc3146739_fk FOREIGN KEY (rev) REFERENCES revisions (id) ON UPDATE NO ACTION ON DELETE NO ACTION;');
        $this->addSql('DROP INDEX IDX_A953172996ADBADE ON citizen;');
        $this->addSql('ALTER TABLE citizen CHANGE colony_id town_id INT DEFAULT NULL, CHANGE town colony VARCHAR(255) DEFAULT NULL;');
        $this->addSql('ALTER TABLE citizen ADD CONSTRAINT FK_A953172975E23604 FOREIGN KEY (town_id) REFERENCES town (id) ON UPDATE NO ACTION ON DELETE NO ACTION;');
        $this->addSql('CREATE INDEX IDX_A953172975E23604 ON citizen (town_id);');
        $this->addSql('ALTER TABLE citizen_audit CHANGE colony_id town_id INT DEFAULT NULL, CHANGE town colony VARCHAR(255) DEFAULT NULL;');
        $this->addSql('DROP INDEX IDX_C1EE637C96ADBADE ON organization;');
        $this->addSql('ALTER TABLE organization CHANGE colony_id town_id INT DEFAULT NULL, CHANGE town colony VARCHAR(255) NOT NULL;');
        $this->addSql('ALTER TABLE organization ADD CONSTRAINT FK_C1EE637C75E23604 FOREIGN KEY (town_id) REFERENCES town (id) ON UPDATE NO ACTION ON DELETE NO ACTION;');
        $this->addSql('CREATE INDEX IDX_C1EE637C75E23604 ON organization (town_id);');
        $this->addSql('ALTER TABLE organization_audit CHANGE colony_id town_id INT DEFAULT NULL, CHANGE town colony VARCHAR(255) DEFAULT NULL;');
        $this->addSql('DROP INDEX IDX_6204B92C96ADBADE ON sales_center;');
        $this->addSql('ALTER TABLE sales_center CHANGE colony_id town_id INT DEFAULT NULL, CHANGE town colony VARCHAR(255) NOT NULL;');
        $this->addSql('ALTER TABLE sales_center ADD CONSTRAINT FK_6204B92C75E23604 FOREIGN KEY (town_id) REFERENCES town (id) ON UPDATE NO ACTION ON DELETE NO ACTION;');
        $this->addSql('ALTER TABLE sales_center_audit CHANGE colony_id town_id INT DEFAULT NULL, CHANGE town colony VARCHAR(255) DEFAULT NULL;');
        $this->addSql('CREATE INDEX IDX_6204B92C75E23604 ON sales_center (town_id);');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
