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

final class Version20231110064829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update `interfactura_fixed_parameter` values.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE interfactura_fixed_parameter ifp  SET ifp.property_path = \'encabezado.notas[1]\' WHERE ifp.property_path = \'encabezado.notas\' ORDER BY ifp.id LIMIT 1;');
        $this->addSql('UPDATE interfactura_fixed_parameter ifp  SET ifp.property_path = \'encabezado.notas[2]\' WHERE ifp.property_path = \'encabezado.notas\' ORDER BY ifp.id LIMIT 1;');
        $this->addSql('UPDATE interfactura_fixed_parameter ifp  SET ifp.property_path = \'encabezado.impuesto.totalImpuestosRetenidos\' WHERE ifp.property_path = \'encabezado.impuestos.totalImpuestosRetenidos\';');
        $this->addSql('UPDATE interfactura_fixed_parameter ifp  SET ifp.property_path = REPLACE(ifp.property_path, \'encabezado.cuerpos.\', \'encabezado.cuerpos[*].\') WHERE ifp.property_path LIKE \'encabezado.cuerpos.%\';');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('UPDATE interfactura_fixed_parameter ifp  SET ifp.property_path = \'encabezado.notas\' WHERE ifp.property_path = \'encabezado.notas[1]\';');
        $this->addSql('UPDATE interfactura_fixed_parameter ifp  SET ifp.property_path = \'encabezado.notas\' WHERE ifp.property_path = \'encabezado.notas[2]\';');
        $this->addSql('UPDATE interfactura_fixed_parameter ifp  SET ifp.property_path = \'encabezado.impuestos.totalImpuestosRetenidos\' WHERE ifp.property_path = \'encabezado.impuesto.totalImpuestosRetenidos\';');
        $this->addSql('UPDATE interfactura_fixed_parameter ifp  SET ifp.property_path = REPLACE(ifp.property_path, \'encabezado.cuerpos[*].\', \'encabezado.cuerpos.\') WHERE ifp.property_path LIKE \'encabezado.cuerpos[*].%\';');
    }

    public function isTransactional(): bool
    {
        return true;
    }
}
