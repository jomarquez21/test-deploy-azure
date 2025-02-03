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

final class Version20231215014853 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add a default value for `legal_code` column to `organization`.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE `organization` set `organization`.`legal_code` = UPPER(SUBSTRING(`organization`.`name`, 1, 3));');
        $this->addSql('UPDATE interfactura_cuerpo SET product_id = (SELECT p.id FROM product p WHERE p.bar_code = codigo_upc LIMIT 1);');
        $this->addSql('UPDATE interfactura_cuerpo SET product_internal_code = (SELECT p.internal_code FROM product p WHERE p.bar_code = codigo_upc LIMIT 1);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('UPDATE `organization` set `organization`.`legal_code` = NULL;');
        $this->addSql('UPDATE interfactura_cuerpo SET product_id = NULL;');
        $this->addSql('UPDATE interfactura_cuerpo SET product_internal_code = NULL;');
    }

    public function isTransactional(): bool
    {
        return true;
    }
}
