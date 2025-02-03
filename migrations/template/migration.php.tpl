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

namespace <namespace>;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class <className> extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Migration <className>.';
    }

    public function up(Schema $schema): void
    {
<up>
    }

    public function down(Schema $schema): void
    {
<down>
    }<override>
}
