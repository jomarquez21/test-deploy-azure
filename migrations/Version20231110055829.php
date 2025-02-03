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

final class Version20231110055829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `interfactura_factura` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE interfactura_factura (id INT AUTO_INCREMENT NOT NULL, emisor_id INT NOT NULL, receptor_id INT NOT NULL, encabezado_id INT NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_1E237C36BDF87DF (emisor_id), UNIQUE INDEX UNIQ_1E237C3386D8D01 (receptor_id), UNIQUE INDEX UNIQ_1E237C3DD017133 (encabezado_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE interfactura_factura ADD CONSTRAINT FK_1E237C36BDF87DF FOREIGN KEY (emisor_id) REFERENCES interfactura_emisor (id);');
        $this->addSql('ALTER TABLE interfactura_factura ADD CONSTRAINT FK_1E237C3386D8D01 FOREIGN KEY (receptor_id) REFERENCES interfactura_receptor (id);');
        $this->addSql('ALTER TABLE interfactura_factura ADD CONSTRAINT FK_1E237C3DD017133 FOREIGN KEY (encabezado_id) REFERENCES interfactura_encabezado (id);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE interfactura_factura DROP FOREIGN KEY FK_1E237C36BDF87DF;');
        $this->addSql('ALTER TABLE interfactura_factura DROP FOREIGN KEY FK_1E237C3386D8D01;');
        $this->addSql('ALTER TABLE interfactura_factura DROP FOREIGN KEY FK_1E237C3DD017133;');
        $this->addSql('DROP TABLE interfactura_factura;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
