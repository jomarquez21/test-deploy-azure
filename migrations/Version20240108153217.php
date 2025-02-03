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

final class Version20240108153217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update unique constraints for `Concessionary`.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP INDEX unique_name_client_idx ON concessionary;');
        $this->addSql('CREATE UNIQUE INDEX unique_sales_center_client_idx ON concessionary (sales_center_id, client_id);');
        $this->addSql('CREATE UNIQUE INDEX unique_sales_center_name_idx ON concessionary (sales_center_id, name);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX unique_sales_center_client_idx ON concessionary;');
        $this->addSql('DROP INDEX unique_sales_center_name_idx ON concessionary;');
        $this->addSql('CREATE UNIQUE INDEX unique_name_client_idx ON concessionary (name, client_id);');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
