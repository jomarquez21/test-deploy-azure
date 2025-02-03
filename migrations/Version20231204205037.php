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

final class Version20231204205037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update values to `tax.code` column.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE `tax` SET `code` = \'003-old\' WHERE `name` = \'iva\';');
        $this->addSql('UPDATE `tax` SET `code` = \'003\' WHERE `name` = \'ieps\';');
        $this->addSql('UPDATE `tax` SET `code` = \'002\' WHERE `name` = \'iva\';');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('UPDATE `tax` SET `code` = \'002-old\' WHERE `name` = \'iva\';');
        $this->addSql('UPDATE `tax` SET `code` = \'002\' WHERE `name` = \'ieps\';');
        $this->addSql('UPDATE `tax` SET `code` = \'003\' WHERE `name` = \'iva\';');
    }

    public function isTransactional(): bool
    {
        return true;
    }
}
