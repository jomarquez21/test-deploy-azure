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

final class Version20250130171018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Migration Version20250130171018.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE UNIQUE INDEX UNIQ_906517449F75D7B0 ON invoice (external_id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX UNIQ_906517449F75D7B0 ON invoice;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
