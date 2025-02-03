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

final class Version20230510211025 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adds `concessionary` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE concessionary (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, sales_center_id INT NOT NULL, bank_id INT NOT NULL, name VARCHAR(255) NOT NULL, is_uncollectible TINYINT(1) NOT NULL, is_active TINYINT(1) NOT NULL, operation_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', bank_reference VARCHAR(255) NOT NULL, agreement VARCHAR(255) NOT NULL, tax_document VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_A5F7D4CD19EB6921 (client_id), INDEX IDX_A5F7D4CD657CAB3E (sales_center_id), INDEX IDX_A5F7D4CD11C8FB41 (bank_id), UNIQUE INDEX unique_name_client_idx (name, client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE concessionary ADD CONSTRAINT FK_A5F7D4CD19EB6921 FOREIGN KEY (client_id) REFERENCES client (id);');
        $this->addSql('ALTER TABLE concessionary ADD CONSTRAINT FK_A5F7D4CD11C8FB41 FOREIGN KEY (bank_id) REFERENCES bank (id);');
        $this->addSql('ALTER TABLE concessionary ADD CONSTRAINT FK_A5F7D4CD657CAB3E FOREIGN KEY (sales_center_id) REFERENCES sales_center (id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE concessionary;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
