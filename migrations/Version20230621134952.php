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

final class Version20230621134952 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `product_audit` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product_audit ADD category_id INT DEFAULT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product_audit DROP category_id;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
