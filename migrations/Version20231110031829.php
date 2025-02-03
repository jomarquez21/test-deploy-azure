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

use App\Entity\ApplicationParameter;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20231110031829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Populate `application_parameter` table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(\sprintf('INSERT INTO application_parameter (`name`, `value`) VALUES (\'%s\', \'3\');', ApplicationParameter::NAME_PROMISSORY_NOTE_EXPIRATION_THRESHOLD_IN_DAYS));
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM application_parameter;');
    }
}
