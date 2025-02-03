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

final class Version20230530212159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Alter tables `citizen_mx` and `concessionary` change to relation one-to-one.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE citizen_mx DROP FOREIGN KEY FK_D651A56539BBA722;');
        $this->addSql('DROP INDEX IDX_D651A56539BBA722 ON citizen_mx;');
        $this->addSql('ALTER TABLE citizen_mx DROP concessionary_id;');
        $this->addSql('ALTER TABLE concessionary ADD citizen_mx_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE concessionary ADD CONSTRAINT FK_A5F7D4CDE741E5E3 FOREIGN KEY (citizen_mx_id) REFERENCES citizen_mx (id);');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A5F7D4CDE741E5E3 ON concessionary (citizen_mx_id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE citizen_mx ADD CONSTRAINT FK_D651A56539BBA722 FOREIGN KEY (concessionary_id) REFERENCES concessionary (id);');
        $this->addSql('ALTER TABLE citizen_mx ADD concessionary_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE citizen_mx DROP citizen_mx_id;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
