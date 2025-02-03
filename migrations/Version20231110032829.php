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

final class Version20231110032829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add table `payment_registry`.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE payment_registry (id INT AUTO_INCREMENT NOT NULL, concessionary_id INT NOT NULL, amount DOUBLE PRECISION DEFAULT NULL, bank_transaction_number VARCHAR(255) DEFAULT NULL, operation_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', status ENUM(\'uncollectible\', \'bank-transfer\'), INDEX IDX_8D6E5F6239BBA722 (concessionary_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE payment_registry ADD CONSTRAINT FK_8D6E5F6239BBA722 FOREIGN KEY (concessionary_id) REFERENCES concessionary (id);');
        $this->addSql('ALTER TABLE promissory_note ADD payment_registry_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE promissory_note_audit ADD payment_registry_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE promissory_note ADD CONSTRAINT FK_B092F7169883C66B FOREIGN KEY (payment_registry_id) REFERENCES payment_registry (id);');
        $this->addSql('CREATE INDEX IDX_B092F7169883C66B ON promissory_note (payment_registry_id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE payment_registry DROP FOREIGN KEY FK_530F458339BBA722;');
        $this->addSql('DROP TABLE payment_registry;');
        $this->addSql('ALTER TABLE promissory_note_audit DROP payment_registry;');
        $this->addSql('ALTER TABLE promissory_note DROP FOREIGN KEY FK_B092F7169883C66B;');
        $this->addSql('DROP INDEX IDX_B092F7169883C66B ON promissory_note;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
