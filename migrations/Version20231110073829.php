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

final class Version20231110073829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update length to 255 in `importe_con_letra` column of table `interfactura_encabezado`.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE interfactura_encabezado CHANGE importe_con_letra importe_con_letra VARCHAR(255) NOT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE interfactura_encabezado CHANGE importe_con_letra importe_con_letra VARCHAR(100) NOT NULL;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
