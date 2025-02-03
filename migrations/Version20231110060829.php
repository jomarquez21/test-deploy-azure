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

final class Version20231110060829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update relationship between `interfactura_encabezado` and `interfactura_cuerpo` from "one-to-one" to "one-to-many".';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE interfactura_encabezado_cuerpo (encabezado_id INT NOT NULL, cuerpo_id INT NOT NULL, INDEX IDX_AB83E872DD017133 (encabezado_id), INDEX IDX_AB83E872FBA4E20B (cuerpo_id), PRIMARY KEY(encabezado_id, cuerpo_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE interfactura_encabezado_cuerpo ADD CONSTRAINT FK_AB83E872DD017133 FOREIGN KEY (encabezado_id) REFERENCES interfactura_encabezado (id);');
        $this->addSql('ALTER TABLE interfactura_encabezado_cuerpo ADD CONSTRAINT FK_AB83E872FBA4E20B FOREIGN KEY (cuerpo_id) REFERENCES interfactura_cuerpo (id);');
        $this->addSql('ALTER TABLE interfactura_encabezado DROP FOREIGN KEY FK_6D41CF83FBA4E20B;');
        $this->addSql('DROP INDEX UNIQ_6D41CF83FBA4E20B ON interfactura_encabezado;');
        $this->addSql('ALTER TABLE interfactura_encabezado DROP cuerpo_id;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE interfactura_encabezado_cuerpo DROP FOREIGN KEY FK_AB83E872DD017133;');
        $this->addSql('ALTER TABLE interfactura_encabezado_cuerpo DROP FOREIGN KEY FK_AB83E872FBA4E20B;');
        $this->addSql('DROP TABLE interfactura_encabezado_cuerpo;');
        $this->addSql('ALTER TABLE interfactura_encabezado ADD cuerpo_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE interfactura_encabezado ADD CONSTRAINT FK_6D41CF83FBA4E20B FOREIGN KEY (cuerpo_id) REFERENCES interfactura_cuerpo (id) ON UPDATE NO ACTION ON DELETE NO ACTION;');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6D41CF83FBA4E20B ON interfactura_encabezado (cuerpo_id);');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
