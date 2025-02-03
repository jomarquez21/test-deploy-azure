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

final class Version20231110062829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Populate `tax` table and delete values from `interfactura_fixed_parameter` table that are not required.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DELETE FROM interfactura_fixed_parameter WHERE property_path = \'encabezado.cuerpos.traslados.impuesto\';');
        $this->addSql('DELETE FROM interfactura_fixed_parameter WHERE property_path = \'encabezado.cuerpos.traslados.tasaOCuota\';');
        $this->addSql('DELETE FROM interfactura_fixed_parameter WHERE property_path = \'encabezado.cuerpos.traslados.tipoFactor\';');
        $this->addSql('DELETE FROM interfactura_fixed_parameter WHERE property_path = \'encabezado.cuerpos.traslados.impuesto\';');
        $this->addSql('DELETE FROM interfactura_fixed_parameter WHERE property_path = \'encabezado.cuerpos.traslados.tipoFactor\';');
        $this->addSql('DELETE FROM interfactura_fixed_parameter WHERE property_path = \'encabezado.impuestos.totalImpuestosRetenidos\';');
        $this->addSql('DELETE FROM interfactura_fixed_parameter WHERE property_path = \'encabezado.impuestos.traslados.impuesto\';');
        $this->addSql('DELETE FROM interfactura_fixed_parameter WHERE property_path = \'encabezado.impuestos.traslados.tasaOCuota\';');
        $this->addSql('DELETE FROM interfactura_fixed_parameter WHERE property_path = \'encabezado.impuestos.traslados.tipoFactor\';');
        $this->addSql('DELETE FROM interfactura_fixed_parameter WHERE property_path = \'encabezado.impuestos.traslados.impuesto\';');
        $this->addSql('DELETE FROM interfactura_fixed_parameter WHERE property_path = \'encabezado.impuestos.traslados.tasaOCuota\';');
        $this->addSql('DELETE FROM interfactura_fixed_parameter WHERE property_path = \'encabezado.impuestos.traslados.tipoFactor\';');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.traslados.impuesto\', \'003\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.traslados.tasaOCuota\', \'0.08\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.traslados.tipoFactor\', \'Tasa\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.traslados.impuesto\', \'002\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.traslados.tipoFactor\', \'Tasa\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.impuestos.totalImpuestosRetenidos\', \'0.00\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.impuestos.traslados.impuesto\', \'003\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.impuestos.traslados.tasaOCuota\', \'0.08\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.impuestos.traslados.tipoFactor\', \'Tasa\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.impuestos.traslados.impuesto\', \'002\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.impuestos.traslados.tasaOCuota\', \'0.16\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.impuestos.traslados.tipoFactor\', \'Tasa\');');
    }

    public function isTransactional(): bool
    {
        return true;
    }
}
