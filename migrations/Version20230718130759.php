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

final class Version20230718130759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add tables `promissory_note` and `promissory_note_audit` tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE promissory_note (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, concessionary_id INT NOT NULL, sales_center_id INT NOT NULL, status ENUM(\'uncollectible\', \'expired\', \'current\', \'paid\'), amount DOUBLE PRECISION NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_B092F71619EB6921 (client_id), INDEX IDX_B092F71639BBA722 (concessionary_id), INDEX IDX_B092F716657CAB3E (sales_center_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE promissory_note_audit (id INT NOT NULL, rev INT NOT NULL, client_id INT DEFAULT NULL, concessionary_id INT DEFAULT NULL, sales_center_id INT DEFAULT NULL, status ENUM(\'uncollectible\', \'expired\', \'current\', \'paid\'), amount DOUBLE PRECISION DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', revtype VARCHAR(4) NOT NULL, INDEX rev_c1e3bf126ec2cb4fde1e81f79f27a6f7_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE promissory_note ADD CONSTRAINT FK_B092F71619EB6921 FOREIGN KEY (client_id) REFERENCES client (id);');
        $this->addSql('ALTER TABLE promissory_note ADD CONSTRAINT FK_B092F71639BBA722 FOREIGN KEY (concessionary_id) REFERENCES concessionary (id);');
        $this->addSql('ALTER TABLE promissory_note ADD CONSTRAINT FK_B092F716657CAB3E FOREIGN KEY (sales_center_id) REFERENCES sales_center (id);');
        $this->addSql('ALTER TABLE promissory_note_audit ADD CONSTRAINT rev_c1e3bf126ec2cb4fde1e81f79f27a6f7_fk FOREIGN KEY (rev) REFERENCES revisions (id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE promissory_note DROP FOREIGN KEY FK_B092F71619EB6921;');
        $this->addSql('ALTER TABLE promissory_note DROP FOREIGN KEY FK_B092F71639BBA722;');
        $this->addSql('ALTER TABLE promissory_note DROP FOREIGN KEY FK_B092F716657CAB3E;');
        $this->addSql('ALTER TABLE promissory_note_audit DROP FOREIGN KEY rev_c1e3bf126ec2cb4fde1e81f79f27a6f7_fk;');
        $this->addSql('DROP TABLE promissory_note;');
        $this->addSql('DROP TABLE promissory_note_audit;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
