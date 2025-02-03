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

final class Version20231110043829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `state_id`, `town_id`, `municipality_id`, `tax_regime_issuer`, `rfc`, `street`, `internal_number`, `external_number` and `zip_code` columns to `organization` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE organization ADD state_id INT NOT NULL, ADD town_id INT DEFAULT NULL, ADD municipality_id INT NOT NULL, ADD tax_regime_issuer VARCHAR(255) NOT NULL, ADD rfc VARCHAR(255) NOT NULL, ADD street VARCHAR(255) NOT NULL, ADD internal_number VARCHAR(255) DEFAULT NULL, ADD external_number VARCHAR(255) NOT NULL, ADD zip_code VARCHAR(255) NOT NULL;');
        $this->addSql('ALTER TABLE organization ADD CONSTRAINT FK_C1EE637C5D83CC1 FOREIGN KEY (state_id) REFERENCES state (id);');
        $this->addSql('ALTER TABLE organization ADD CONSTRAINT FK_C1EE637C75E23604 FOREIGN KEY (town_id) REFERENCES town (id);');
        $this->addSql('ALTER TABLE organization ADD CONSTRAINT FK_C1EE637CAE6F181C FOREIGN KEY (municipality_id) REFERENCES municipality (id);');
        $this->addSql('CREATE INDEX IDX_C1EE637C5D83CC1 ON organization (state_id);');
        $this->addSql('CREATE INDEX IDX_C1EE637C75E23604 ON organization (town_id);');
        $this->addSql('CREATE INDEX IDX_C1EE637CAE6F181C ON organization (municipality_id);');
        $this->addSql('ALTER TABLE organization CHANGE country_id country_id INT NOT NULL;');
        $this->addSql('ALTER TABLE organization_audit ADD state_id INT DEFAULT NULL, ADD town_id INT DEFAULT NULL, ADD municipality_id INT DEFAULT NULL, ADD tax_regime_issuer VARCHAR(255) DEFAULT NULL, ADD rfc VARCHAR(255) DEFAULT NULL, ADD street VARCHAR(255) DEFAULT NULL, ADD internal_number VARCHAR(255) DEFAULT NULL, ADD external_number VARCHAR(255) DEFAULT NULL, ADD zip_code VARCHAR(255) DEFAULT NULL;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE organization CHANGE country_id country_id INT DEFAULT NULL;');
        $this->addSql('ALTER TABLE organization DROP FOREIGN KEY FK_C1EE637C5D83CC1;');
        $this->addSql('ALTER TABLE organization DROP FOREIGN KEY FK_C1EE637C75E23604;');
        $this->addSql('ALTER TABLE organization DROP FOREIGN KEY FK_C1EE637CAE6F181C;');
        $this->addSql('DROP INDEX IDX_C1EE637C5D83CC1 ON organization;');
        $this->addSql('DROP INDEX IDX_C1EE637C75E23604 ON organization;');
        $this->addSql('DROP INDEX IDX_C1EE637CAE6F181C ON organization;');
        $this->addSql('ALTER TABLE organization DROP state_id, DROP town_id, DROP municipality_id, DROP tax_regime_issuer, DROP rfc, DROP street, DROP internal_number, DROP external_number, DROP zip_code;');
        $this->addSql('ALTER TABLE organization_audit DROP state_id, DROP town_id, DROP municipality_id, DROP tax_regime_issuer, DROP rfc, DROP street, DROP internal_number, DROP external_number, DROP zip_code;');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
