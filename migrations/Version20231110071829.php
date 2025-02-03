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

final class Version20231110071829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update some values of the rows in `interfactura_fixed_parameter` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.impuestos[*].totalImpuestosRetenidos\', \'0.00\');');
        $this->addSql('UPDATE interfactura_fixed_parameter ifp SET ifp.value = \'[Calif_TradingPartner_Prov]\' WHERE ifp.property_path = \'encabezado.califTradingPartnerProv\';');
        $this->addSql('UPDATE interfactura_fixed_parameter ifp SET ifp.value = \'[TradingPartner_Prov]\' WHERE ifp.property_path = \'encabezado.tradingPartnerProv\';');
        $this->addSql('UPDATE interfactura_fixed_parameter ifp SET ifp.value = \'[DEV]\' WHERE ifp.property_path = \'encabezado.misc43\';');
        $this->addSql('UPDATE interfactura_fixed_parameter ifp SET ifp.value = \'[Fecha]\' WHERE ifp.property_path = \'encabezado.fecha\';');
        $this->addSql('UPDATE interfactura_fixed_parameter ifp SET ifp.value = \'[Hora]\' WHERE ifp.property_path = \'encabezado.hora\';');
        $this->addSql('DELETE FROM interfactura_fixed_parameter WHERE property_path = \'encabezado.impuestos.traslados.tasaOCuota\';');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM interfactura_fixed_parameter WHERE property_path = \'encabezado.impuestos[*].totalImpuestosRetenidos\';');
        $this->addSql('UPDATE interfactura_fixed_parameter ifp SET ifp.value = \'\' WHERE ifp.property_path = \'encabezado.califTradingPartnerProv\';');
        $this->addSql('UPDATE interfactura_fixed_parameter ifp SET ifp.value = \'\' WHERE ifp.property_path = \'encabezado.tradingPartnerProv\';');
        $this->addSql('UPDATE interfactura_fixed_parameter ifp SET ifp.value = \'\' WHERE ifp.property_path = \'encabezado.misc43\';');
        $this->addSql('UPDATE interfactura_fixed_parameter ifp SET ifp.value = \'\' WHERE ifp.property_path = \'encabezado.fecha\';');
        $this->addSql('UPDATE interfactura_fixed_parameter ifp SET ifp.value = \'\' WHERE ifp.property_path = \'encabezado.hora\';');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.impuestos.traslados.tasaOCuota\', \'0.08\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.impuestos.traslados.tasaOCuota\', \'0.16\');');
    }

    public function isTransactional(): bool
    {
        return true;
    }
}
