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

final class Version20230808200345 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Replace unique index of `name` for `code` in `sales_center` in table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP INDEX UNIQ_6204B92C5E237E06 ON sales_center;');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6204B92C77153098 ON sales_center (code);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX UNIQ_6204B92C77153098 ON sales_center;');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6204B92C5E237E06 ON sales_center (name);');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
