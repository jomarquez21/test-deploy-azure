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

final class Version20231215014854 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Make some columns not nulleable.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE organization CHANGE legal_code legal_code VARCHAR(3) NOT NULL;');
        $this->addSql('ALTER TABLE interfactura_cuerpo CHANGE product_id product_id INT NOT NULL, CHANGE product_internal_code product_internal_code VARCHAR(255) NOT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE organization CHANGE legal_code legal_code VARCHAR(3) DEFAULT NULL;');
        $this->addSql('ALTER TABLE interfactura_cuerpo CHANGE product_id product_id INT DEFAULT NULL, CHANGE product_internal_code product_internal_code VARCHAR(255) DEFAULT NULL;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
