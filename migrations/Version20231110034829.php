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

final class Version20231110034829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Populate `interfactura_fixed_parameter` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'emisor.telefono\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'emisor.domicilio.referencia\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'emisor.sucursal.referencia\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'emisor.sucursal.telefono\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'receptor.numRegIdTrib\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'receptor.residenciaFiscal\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'receptor.email\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'receptor.domicilio.referencia\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.formaPago\', \'01\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.alternateIdentificationGln\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.anoAprobacion\', \'2023\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cfdiExportacion\', \'01\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.versionCFDI\', \'4.0\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.califTradingPartnerProv\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.iva\', \'0.00\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.ivaPct\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.LOB\', \'ISA2\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.metodoPago\', \'PUE\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.fecha\', \'2023-10-10\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.hora\', \'01:01:00\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.moneda\', \'MXN\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cantidadEmpaques\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.tradingPartnerProv\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc12\', \'RECUPERACIONES\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc15\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc43\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.codDescuento\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.codZona\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.codigoVendedor\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.condicionPago\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.consecutivoInterno\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.contactoCompras\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.customsGln\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.deliveryDate\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.descricpcionMoneda\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.diasPago\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.documentStatus\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.eanLugarExpide\', \'1\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.eanProveedor\', \'1\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.eanReceptor\', \'1\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.estatus\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.fechaFolioFiscalOrig\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.fechaNumeroContraRecibo\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.fechaOrdenCompra\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.fechaPedido\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.fechaVencimiento\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.funcDivisa\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.iepsId\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.numeroOrdenCompra\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.numeroReceptor\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.numeroSolicitud\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.porcentajeDescuento\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.porcentajeDescuentoProntoPago\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.porcentajeNoPlicado\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.procesoId\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.refTerminoTiempoPago\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.refTiempoPago\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.tipoCambio\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.numProveedor\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.tienda.eanTienda\', \'1\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.tienda.noTienda\', \'1\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.tipoEspecialServicio\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.transportista\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.viaEmbarque\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.montoDescuento\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.montoDescuentoProntoPago\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.montoFolioFiscalOrig\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.montoMerma\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.montoTotalDescuento\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.motivoDescuento\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.notas\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.notas\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc02\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc07\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc10\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc13\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc14\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc18\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc20\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc21\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc22\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc23\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc24\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc25\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc26\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc27\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc34\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc38\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc39\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc40\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc41\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc42\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc46\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc47\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.misc48\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.numCtaPago\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.numPedido\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.numeroContraRecibo\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.numeroEmisor\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.nombreAduana\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.nombreAduanaCiudad\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.nombreVendedor\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.aduanas.aduanaFechaDoc\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.aduanas.aduanaNombre\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.aduanas.aduanaNumDoc\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.aduanas.fraccionArancelaria\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.aduanas.frontera\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.aduanas.paisOrigen\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.califNumIdentidad\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.cantidadAdicional\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.cantidadAdicionalTipo\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.cantidadEmpaquesEmbarcados\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.cantidadEmpaquesFaturados\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.cfdiObjetoImp\', \'02\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.codigoDescuento\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.codigoEan\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.codigoUdn\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.cuentaPredialNumero\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.descripcionIdioma\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.descuento\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.eanAduana\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.fechaProduccionLote\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.identificacionImpuesto\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.iepsPct\', \'8\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.importeConImpuesto\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.indCargoDescuento\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.infCargoDescuento\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.medicionSecundaria\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.metodoPago\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc02\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc03\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc04\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc05\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc06\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc07\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc08\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc09\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc12\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc13\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc14\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc15\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc16\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc17\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc18\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc19\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc20\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc21\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc22\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc23\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc24\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc25\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc26\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc27\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc28\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc29\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc30\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc31\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc32\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc33\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc34\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc35\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc36\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc37\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc38\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc39\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc40\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc41\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc42\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc43\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc44\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc45\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc46\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc47\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc48\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.misc49\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.noIdentificacion\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.notas\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.numeroLote\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.piezasEmpaques\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.porcentajeDescuento\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.secuenciaCalculo\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.tipoEmpaquetado\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.tipoIdentificacionAdicional\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.tipoReferencia\', \'\');');
        $this->addSql('INSERT INTO interfactura_fixed_parameter (`property_path`, `value`) VALUES (\'encabezado.cuerpos.tipoServicioEsp\', \'\');');
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

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM interfactura_fixed_parameter;');
    }
}
