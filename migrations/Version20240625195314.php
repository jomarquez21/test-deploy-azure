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

final class Version20240625195314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add multiple deposit receipt to payment registry.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE payment_deposit_receipt (id INT AUTO_INCREMENT NOT NULL, payment_registry_id INT NOT NULL, bank_id INT NOT NULL, sales_center_id INT NOT NULL, amount DOUBLE PRECISION DEFAULT NULL, bank_transaction_number VARCHAR(255) DEFAULT NULL, payment_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_55DBA0BDBA3BD737 (payment_registry_id), INDEX IDX_55DBA0BD11C8FB41 (bank_id), INDEX IDX_55DBA0BD657CAB3E (sales_center_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE payment_deposit_receipt ADD CONSTRAINT FK_55DBA0BDBA3BD737 FOREIGN KEY (payment_registry_id) REFERENCES payment_registry (id);');
        $this->addSql('ALTER TABLE payment_deposit_receipt ADD CONSTRAINT FK_55DBA0BD11C8FB41 FOREIGN KEY (bank_id) REFERENCES bank (id);');
        $this->addSql('ALTER TABLE payment_deposit_receipt ADD CONSTRAINT FK_55DBA0BD657CAB3E FOREIGN KEY (sales_center_id) REFERENCES sales_center (id);');
        $this->addSql('DROP INDEX UNIQ_8D6E5F62FA53DB88 ON payment_registry;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE payment_deposit_receipt DROP FOREIGN KEY FK_55DBA0BDBA3BD737;');
        $this->addSql('ALTER TABLE payment_deposit_receipt DROP FOREIGN KEY FK_55DBA0BD11C8FB41;');
        $this->addSql('ALTER TABLE payment_deposit_receipt DROP FOREIGN KEY FK_55DBA0BD657CAB3E;');
        $this->addSql('DROP TABLE payment_deposit_receipt;');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D6E5F62FA53DB88 ON payment_registry (bank_transaction_number);');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
