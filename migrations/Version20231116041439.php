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

final class Version20231116041439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Migration Version20231116041439.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE devolution_return CHANGE warehouse warehouse VARCHAR(255) NOT NULL, CHANGE region region VARCHAR(255) NOT NULL, CHANGE devolution_reference devolution_reference VARCHAR(255) NOT NULL, CHANGE control_number control_number INT NOT NULL;');
        $this->addSql('ALTER TABLE devolution_system_product CHANGE devolution_return_id devolution_return_id INT NOT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE devolution_return CHANGE warehouse warehouse VARCHAR(255) DEFAULT NULL, CHANGE region region VARCHAR(255) DEFAULT NULL, CHANGE devolution_reference devolution_reference VARCHAR(255) DEFAULT NULL, CHANGE control_number control_number INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE devolution_system_product CHANGE devolution_return_id devolution_return_id INT DEFAULT NULL;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
