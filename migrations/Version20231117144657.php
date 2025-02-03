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

final class Version20231117144657 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add missing `sales_center_id` column in several tables where this association is required.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE classification ADD sales_center_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE classification ADD CONSTRAINT FK_456BD231657CAB3E FOREIGN KEY (sales_center_id) REFERENCES sales_center (id);');
        $this->addSql('CREATE INDEX IDX_456BD231657CAB3E ON classification (sales_center_id);');
        $this->addSql('ALTER TABLE classification_audit ADD sales_center_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE concessionary_category_group ADD sales_center_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE concessionary_category_group ADD CONSTRAINT FK_1B94986E657CAB3E FOREIGN KEY (sales_center_id) REFERENCES sales_center (id);');
        $this->addSql('CREATE INDEX IDX_1B94986E657CAB3E ON concessionary_category_group (sales_center_id);');
        $this->addSql('ALTER TABLE concessionary_category_group_audit ADD sales_center_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE distribution ADD sales_center_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE distribution ADD CONSTRAINT FK_A4483781657CAB3E FOREIGN KEY (sales_center_id) REFERENCES sales_center (id);');
        $this->addSql('CREATE INDEX IDX_A4483781657CAB3E ON distribution (sales_center_id);');
        $this->addSql('ALTER TABLE distribution_audit ADD sales_center_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE distribution_product ADD sales_center_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE distribution_product ADD CONSTRAINT FK_33FB4A1F657CAB3E FOREIGN KEY (sales_center_id) REFERENCES sales_center (id);');
        $this->addSql('CREATE INDEX IDX_33FB4A1F657CAB3E ON distribution_product (sales_center_id);');
        $this->addSql('ALTER TABLE distribution_product_audit ADD sales_center_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE promissory_note RENAME INDEX idx_b092f7169883c66b TO IDX_B092F716BA3BD737;');
        $this->addSql('ALTER TABLE payment_registry ADD sales_center_id INT NOT NULL, CHANGE status status ENUM(\'uncollectible\', \'bank-transfer\');');
        $this->addSql('ALTER TABLE payment_registry ADD CONSTRAINT FK_8D6E5F62657CAB3E FOREIGN KEY (sales_center_id) REFERENCES sales_center (id);');
        $this->addSql('CREATE INDEX IDX_8D6E5F62657CAB3E ON payment_registry (sales_center_id);');
        $this->addSql('ALTER TABLE payment_registry_audit ADD sales_center_id INT DEFAULT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE classification DROP FOREIGN KEY FK_456BD231657CAB3E;');
        $this->addSql('DROP INDEX IDX_456BD231657CAB3E ON classification;');
        $this->addSql('ALTER TABLE classification DROP sales_center_id;');
        $this->addSql('ALTER TABLE classification_audit DROP sales_center_id;');
        $this->addSql('ALTER TABLE concessionary_category_group DROP FOREIGN KEY FK_1B94986E657CAB3E;');
        $this->addSql('DROP INDEX IDX_1B94986E657CAB3E ON concessionary_category_group;');
        $this->addSql('ALTER TABLE concessionary_category_group DROP sales_center_id;');
        $this->addSql('ALTER TABLE concessionary_category_group_audit DROP sales_center_id;');
        $this->addSql('ALTER TABLE distribution DROP FOREIGN KEY FK_A4483781657CAB3E;');
        $this->addSql('DROP INDEX IDX_A4483781657CAB3E ON distribution;');
        $this->addSql('ALTER TABLE distribution DROP sales_center_id;');
        $this->addSql('ALTER TABLE distribution_audit DROP sales_center_id;');
        $this->addSql('ALTER TABLE distribution_product DROP FOREIGN KEY FK_33FB4A1F657CAB3E;');
        $this->addSql('DROP INDEX IDX_33FB4A1F657CAB3E ON distribution_product;');
        $this->addSql('ALTER TABLE distribution_product DROP sales_center_id;');
        $this->addSql('ALTER TABLE distribution_product_audit DROP sales_center_id;');
        $this->addSql('ALTER TABLE promissory_note RENAME INDEX idx_b092f716ba3bd737 TO IDX_B092F7169883C66B;');
        $this->addSql('ALTER TABLE payment_registry DROP FOREIGN KEY FK_8D6E5F62657CAB3E;');
        $this->addSql('DROP INDEX IDX_8D6E5F62657CAB3E ON payment_registry;');
        $this->addSql('ALTER TABLE payment_registry DROP sales_center_id, CHANGE status status VARCHAR(255) DEFAULT NULL;');
        $this->addSql('ALTER TABLE payment_registry_audit DROP sales_center_id;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
