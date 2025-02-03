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

final class Version20231110062029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add values to `tax.code` column.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE tax CHANGE code code VARCHAR(255) NOT NULL;');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8E81BA7677153098 ON tax (code);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX UNIQ_8E81BA7677153098 ON tax;');
        $this->addSql('ALTER TABLE tax CHANGE code code VARCHAR(255) DEFAULT NULL;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
