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

final class Version20240624161354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adds `journal_entry_logger` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE journal_entry_audit (id INT NOT NULL, rev INT NOT NULL, sales_center_id INT DEFAULT NULL, operation_date_reference VARCHAR(255) DEFAULT NULL, sales_center_code VARCHAR(255) DEFAULT NULL, source_system VARCHAR(255) DEFAULT NULL, country_code VARCHAR(255) DEFAULT NULL, organization_legal_code VARCHAR(255) DEFAULT NULL, route_identifier VARCHAR(255) DEFAULT NULL, layout_version VARCHAR(255) DEFAULT NULL, cost_center_code VARCHAR(255) DEFAULT NULL, sent_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', status ENUM(\'process-failure\', \'processing\', \'process-success\', \'unprocessed\'), type ENUM(\'inventory-journal-entry\', \'invoice-journal-entry\', \'payment-registry-journal-entry\'), created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', discr VARCHAR(255) DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_4d092641bd5df9d2c5ca62d51d7dda0c_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE journal_entry_logger (id INT AUTO_INCREMENT NOT NULL, sales_center_id INT NOT NULL, user_id INT DEFAULT NULL, file_name VARCHAR(255) NOT NULL, total_lines INT NOT NULL, status ENUM(\'downloaded\', \'send-failure\', \'sending\', \'send-success\'), created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7483BC02657CAB3E (sales_center_id), INDEX IDX_7483BC02A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE journal_entry_logger_journal_entry (journal_entry_logger_id INT NOT NULL, journal_entry_id INT NOT NULL, INDEX IDX_E2CFC77B59042204 (journal_entry_logger_id), UNIQUE INDEX UNIQ_E2CFC77B6A86E4FB (journal_entry_id), PRIMARY KEY(journal_entry_logger_id, journal_entry_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE journal_entry_logger_audit (id INT NOT NULL, rev INT NOT NULL, sales_center_id INT DEFAULT NULL, user_id INT DEFAULT NULL, file_name VARCHAR(255) DEFAULT NULL, total_lines INT DEFAULT NULL, status ENUM(\'downloaded\', \'send-failure\', \'sending\', \'send-success\'), created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', revtype VARCHAR(4) NOT NULL, INDEX rev_770556d48091cfb3524da5ed3061a174_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE journal_entry_logger_journal_entry_audit (journal_entry_logger_id INT NOT NULL, journal_entry_id INT NOT NULL, rev INT NOT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_cb23e7bf25da3c7f6e813bcd7fee976e_idx (rev), PRIMARY KEY(journal_entry_logger_id, journal_entry_id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE journal_entry_audit ADD CONSTRAINT rev_4d092641bd5df9d2c5ca62d51d7dda0c_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
        $this->addSql('ALTER TABLE journal_entry_logger ADD CONSTRAINT FK_7483BC02657CAB3E FOREIGN KEY (sales_center_id) REFERENCES sales_center (id);');
        $this->addSql('ALTER TABLE journal_entry_logger ADD CONSTRAINT FK_7483BC02A76ED395 FOREIGN KEY (user_id) REFERENCES user (id);');
        $this->addSql('ALTER TABLE journal_entry_logger_journal_entry ADD CONSTRAINT FK_E2CFC77B59042204 FOREIGN KEY (journal_entry_logger_id) REFERENCES journal_entry_logger (id);');
        $this->addSql('ALTER TABLE journal_entry_logger_journal_entry ADD CONSTRAINT FK_E2CFC77B6A86E4FB FOREIGN KEY (journal_entry_id) REFERENCES journal_entry (id) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE journal_entry_logger_audit ADD CONSTRAINT rev_770556d48091cfb3524da5ed3061a174_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE journal_entry_audit DROP FOREIGN KEY rev_4d092641bd5df9d2c5ca62d51d7dda0c_fk;');
        $this->addSql('ALTER TABLE journal_entry_logger DROP FOREIGN KEY FK_7483BC02657CAB3E;');
        $this->addSql('ALTER TABLE journal_entry_logger DROP FOREIGN KEY FK_7483BC02A76ED395;');
        $this->addSql('ALTER TABLE journal_entry_logger_journal_entry DROP FOREIGN KEY FK_E2CFC77B59042204;');
        $this->addSql('ALTER TABLE journal_entry_logger_journal_entry DROP FOREIGN KEY FK_E2CFC77B6A86E4FB;');
        $this->addSql('ALTER TABLE journal_entry_logger_audit DROP FOREIGN KEY rev_770556d48091cfb3524da5ed3061a174_fk;');
        $this->addSql('DROP TABLE journal_entry_audit;');
        $this->addSql('DROP TABLE journal_entry_logger;');
        $this->addSql('DROP TABLE journal_entry_logger_journal_entry;');
        $this->addSql('DROP TABLE journal_entry_logger_audit;');
        $this->addSql('DROP TABLE journal_entry_logger_journal_entry_audit;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
