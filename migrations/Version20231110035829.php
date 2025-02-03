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

final class Version20231110035829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add table `payment_registry_audit`.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE payment_registry_audit (id INT NOT NULL, rev INT NOT NULL, concessionary_id INT DEFAULT NULL, amount DOUBLE PRECISION DEFAULT NULL, bank_transaction_number VARCHAR(255) DEFAULT NULL, operation_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', status ENUM(\'uncollectible\', \'bank-transfer\'), revtype VARCHAR(4) NOT NULL, INDEX rev_fdcac7871f8510e5d21a9e215a488111_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE payment_registry_audit ADD CONSTRAINT rev_fdcac7871f8510e5d21a9e215a488111_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE payment_registry_audit DROP FOREIGN KEY rev_fdcac7871f8510e5d21a9e215a488111_fk;');
        $this->addSql('DROP TABLE payment_registry_audit;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
