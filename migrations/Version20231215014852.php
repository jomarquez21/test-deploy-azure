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

final class Version20231215014852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return
            'Add several columns to `organization`, `product`, `product_category`, `distribution` and '
            .' `classification_group` tables for accountability.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE organization ADD legal_code VARCHAR(3) DEFAULT NULL;');
        $this->addSql('ALTER TABLE organization_audit ADD legal_code VARCHAR(3) DEFAULT NULL;');
        $this->addSql('ALTER TABLE product ADD packaging_capacity INT DEFAULT 0 NOT NULL;');
        $this->addSql('ALTER TABLE product_audit ADD packaging_capacity INT DEFAULT 0;');
        $this->addSql('ALTER TABLE product_category ADD subline_code VARCHAR(40) DEFAULT NULL;');
        $this->addSql('ALTER TABLE product_category_audit ADD subline_code VARCHAR(40) DEFAULT NULL;');
        $this->addSql('ALTER TABLE classification_group CHANGE end_of_cycle_at swept_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\';');
        $this->addSql('ALTER TABLE classification_group_audit CHANGE end_of_cycle_at swept_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\';');
        $this->addSql('ALTER TABLE distribution ADD delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE end_of_cycle_at swept_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\';');
        $this->addSql('ALTER TABLE distribution_audit ADD delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE end_of_cycle_at swept_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\';');
        $this->addSql('ALTER TABLE interfactura_cuerpo ADD product_id INT DEFAULT NULL, ADD product_internal_code VARCHAR(255) DEFAULT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE organization DROP legal_code;');
        $this->addSql('ALTER TABLE organization_audit DROP legal_code;');
        $this->addSql('ALTER TABLE product DROP packaging_capacity;');
        $this->addSql('ALTER TABLE product_audit DROP packaging_capacity;');
        $this->addSql('ALTER TABLE product_category DROP subline_code;');
        $this->addSql('ALTER TABLE product_category_audit DROP subline_code;');
        $this->addSql('ALTER TABLE classification_group CHANGE swept_at end_of_cycle_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\';');
        $this->addSql('ALTER TABLE classification_group_audit CHANGE swept_at end_of_cycle_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\';');
        $this->addSql('ALTER TABLE distribution CHANGE swept_at end_of_cycle_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP delivered_at;');
        $this->addSql('ALTER TABLE distribution_audit CHANGE swept_at end_of_cycle_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP delivered_at;');
        $this->addSql('ALTER TABLE interfactura_cuerpo DROP product_id, DROP product_internal_code;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
