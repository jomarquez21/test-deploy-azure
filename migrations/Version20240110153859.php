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

final class Version20240110153859 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Chance `town` column to `colony`.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE client CHANGE town colony VARCHAR(255) DEFAULT NULL;');
        $this->addSql('ALTER TABLE client_audit CHANGE town colony VARCHAR(255) DEFAULT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE client CHANGE colony town VARCHAR(255) DEFAULT NULL;');
        $this->addSql('ALTER TABLE client_audit CHANGE colony town VARCHAR(255) DEFAULT NULL;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
