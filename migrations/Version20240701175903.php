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

final class Version20240701175903 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Fix missing field "code" from table "bank".';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP VIEW IF EXISTS v_catalogo_concesionarios;');

        $sqlString = <<<'SQL'
            CREATE VIEW v_catalogo_concesionarios AS
                SELECT
                    sales_center.code AS codigo_ceve,
                    client.party_number AS codigo_cliente,
                    concessionary.name AS nombre_concesionario,
                    concessionary.operation_date AS fecha_operacion,
                    concessionary.tax_document AS documento_fiscal,
                    IF
                        (concessionary.is_uncollectible = 1,'si', 'no') AS incobrable,
                    IF
                        (concessionary.is_active = 1,'si', 'no') AS activo,
                    bank.code AS codigo_banco,
                    concessionary.bank_reference AS referencia,
                    concessionary.account_number AS numero_cuenta,
                    concessionary.agreement AS convenio,
                    citizen.fullname AS ine_nombre,
                    IF
                        (citizen.gender = 'male','masculino', 'femenino') AS ine_genero,
                    citizen.street AS ine_calle,
                    citizen.external_number AS ine_num_ext,
                    citizen.internal_number AS ine_num_int,
                    country.name AS ine_pais,
                    state.name AS ine_estado,
                    municipality.name AS ine_municipio,
                    colony.name AS ine_colonia,
                    citizen.town AS ine_ciudad,
                    citizen.zip_code AS ine_cp,
                    citizen.voter_key AS ine_clave_elector,
                    citizen.population_id AS ine_curp,
                    citizen.tax_register AS ine_rfc
                FROM
                    concessionary
                INNER JOIN
                        sales_center ON concessionary.sales_center_id = sales_center.id
                INNER JOIN
                        client ON concessionary.client_id = client.id
                INNER JOIN
                        citizen ON concessionary.citizen_id = citizen.id
                INNER JOIN
                        country ON citizen.country_id = country.id
                INNER JOIN
                        state ON citizen.state_id = state.id
                INNER JOIN
                        municipality ON citizen.municipality_id = municipality.id
                INNER JOIN
                        colony ON citizen.colony_id = colony.id
                INNER JOIN
                        bank ON concessionary.bank_id = bank.id;
            SQL;

        $this->addSql($sqlString);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP VIEW IF EXISTS v_catalogo_concesionarios;');

        $sqlString = <<<'SQL'
            CREATE VIEW v_catalogo_concesionarios AS
                SELECT
                    sales_center.code AS codigo_ceve,
                    client.party_number AS codigo_cliente,
                    concessionary.name AS nombre_concesionario,
                    concessionary.operation_date AS fecha_operacion,
                    concessionary.tax_document AS documento_fiscal,
                    IF
                        (concessionary.is_uncollectible = 1,'si', 'no') AS incobrable,
                    IF
                        (concessionary.is_active = 1,'si', 'no') AS activo,
                    concessionary.bank_reference AS referencia,
                    concessionary.account_number AS numero_cuenta,
                    concessionary.agreement AS convenio,
                    citizen.fullname AS ine_nombre,
                    IF
                        (citizen.gender = 'male','masculino', 'femenino') AS ine_genero,
                    citizen.street AS ine_calle,
                    citizen.external_number AS ine_num_ext,
                    citizen.internal_number AS ine_num_int,
                    country.name AS ine_pais,
                    state.name AS ine_estado,
                    municipality.name AS ine_municipio,
                    colony.name AS ine_colonia,
                    citizen.town AS ine_ciudad,
                    citizen.zip_code AS ine_cp,
                    citizen.voter_key AS ine_clave_elector,
                    citizen.population_id AS ine_curp,
                    citizen.tax_register AS ine_rfc
                FROM
                    concessionary
                INNER JOIN
                        sales_center ON concessionary.sales_center_id = sales_center.id
                INNER JOIN
                        client ON concessionary.client_id = client.id
                INNER JOIN
                        citizen ON concessionary.citizen_id = citizen.id
                INNER JOIN
                        country ON citizen.country_id = country.id
                INNER JOIN
                        state ON citizen.state_id = state.id
                INNER JOIN
                        municipality ON citizen.municipality_id = municipality.id
                INNER JOIN
                        colony ON citizen.colony_id = colony.id;
            SQL;

        $this->addSql($sqlString);
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
