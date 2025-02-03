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

final class Version20231110070829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update the relationship between `Encabezado` and `Impuesto` tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE interfactura_encabezado_impuesto (encabezado_id INT NOT NULL, impuesto_id INT NOT NULL, INDEX IDX_326E7499DD017133 (encabezado_id), INDEX IDX_326E7499D23B6BE5 (impuesto_id), PRIMARY KEY(encabezado_id, impuesto_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE interfactura_encabezado_impuesto ADD CONSTRAINT FK_326E7499DD017133 FOREIGN KEY (encabezado_id) REFERENCES interfactura_encabezado (id);');
        $this->addSql('ALTER TABLE interfactura_encabezado_impuesto ADD CONSTRAINT FK_326E7499D23B6BE5 FOREIGN KEY (impuesto_id) REFERENCES interfactura_impuesto (id);');
        $this->addSql('ALTER TABLE interfactura_encabezado DROP FOREIGN KEY FK_6D41CF83D23B6BE5;');
        $this->addSql('DROP INDEX UNIQ_6D41CF83D23B6BE5 ON interfactura_encabezado;');
        $this->addSql('ALTER TABLE interfactura_encabezado DROP impuesto_id;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE interfactura_encabezado_impuesto DROP FOREIGN KEY FK_326E7499DD017133;');
        $this->addSql('ALTER TABLE interfactura_encabezado_impuesto DROP FOREIGN KEY FK_326E7499D23B6BE5;');
        $this->addSql('DROP TABLE interfactura_encabezado_impuesto;');
        $this->addSql('ALTER TABLE interfactura_encabezado ADD impuesto_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE interfactura_encabezado ADD CONSTRAINT FK_6D41CF83D23B6BE5 FOREIGN KEY (impuesto_id) REFERENCES interfactura_impuesto (id) ON UPDATE NO ACTION ON DELETE NO ACTION;');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6D41CF83D23B6BE5 ON interfactura_encabezado (impuesto_id);');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
