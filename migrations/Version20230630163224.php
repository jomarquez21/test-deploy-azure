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

final class Version20230630163224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `country_id` column and update default value of `external_number` as `null` in `sales_center` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sales_center ADD country_id INT NOT NULL, CHANGE external_number external_number VARCHAR(255) DEFAULT NULL;');
        $this->addSql('ALTER TABLE sales_center ADD CONSTRAINT FK_6204B92CF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id);');
        $this->addSql('CREATE INDEX IDX_6204B92CF92F3E70 ON sales_center (country_id);');
        $this->addSql('ALTER TABLE sales_center_audit ADD country_id INT DEFAULT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sales_center DROP FOREIGN KEY FK_6204B92CF92F3E70;');
        $this->addSql('DROP INDEX IDX_6204B92CF92F3E70 ON sales_center;');
        $this->addSql('ALTER TABLE sales_center DROP country_id, CHANGE external_number external_number VARCHAR(255) NOT NULL;');
        $this->addSql('ALTER TABLE sales_center_audit DROP country_id;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
