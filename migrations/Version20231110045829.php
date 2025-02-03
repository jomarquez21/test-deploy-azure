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

final class Version20231110045829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `debt` field to `concessionary` table and add `distribution_total_amount` field to `promissory_note`.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE concessionary ADD debt DOUBLE PRECISION DEFAULT \'0\' NOT NULL;');
        $this->addSql('ALTER TABLE concessionary_audit ADD debt DOUBLE PRECISION DEFAULT \'0\';');
        $this->addSql('ALTER TABLE payment_registry CHANGE operation_date payment_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\';');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D6E5F62FA53DB88 ON payment_registry (bank_transaction_number);');
        $this->addSql('ALTER TABLE payment_registry_audit CHANGE operation_date payment_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\';');
        $this->addSql('ALTER TABLE promissory_note ADD distribution_total_amount DOUBLE PRECISION NOT NULL;');
        $this->addSql('ALTER TABLE promissory_note_audit ADD distribution_total_amount DOUBLE PRECISION DEFAULT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE concessionary DROP debt;');
        $this->addSql('ALTER TABLE concessionary_audit DROP debt;');
        $this->addSql('DROP INDEX UNIQ_8D6E5F62FA53DB88 ON payment_registry;');
        $this->addSql('ALTER TABLE payment_registry CHANGE payment_date operation_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\';');
        $this->addSql('ALTER TABLE payment_registry_audit CHANGE payment_date operation_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\';');
        $this->addSql('ALTER TABLE promissory_note DROP distribution_total_amount;');
        $this->addSql('ALTER TABLE promissory_note_audit DROP distribution_total_amount;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
