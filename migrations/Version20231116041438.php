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

final class Version20231116041438 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Migration Version20231116041439.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'UPDATE `devolution_system_product` `dsp`'
            .' JOIN `devolution_return` `dr` ON ('
                .' `dr`.`devolution_system_id` = `dsp`.`devolution_system_id`'
                .' AND `dr`.`sales_center_id` = `dsp`.`sales_center_id`'
            .' )'
            .' SET `dsp`.`devolution_return_id` = `dr`.`id`;'
        );

        $this->addSql(
            'UPDATE `devolution_return` `dr`'
            .' SET `dr`.`warehouse` = \'\','
            .'  `dr`.`region` = \'\','
            .'  `dr`.`devolution_reference` = ('
            .'      SELECT DATE_FORMAT(`dsp`.`created_at`, "%Y-%m-%d")'
            .'      FROM `devolution_system_product` `dsp`'
            .'      WHERE `dsp`.`devolution_return_id` = `dr`.`id`'
            .'      LIMIT 1'
            .'  ),'
            .'  `dr`.`control_number` = ('
            .'      SELECT SUM(1)'
            .'      FROM `devolution_system_product` `dsp`'
            .'      WHERE `dsp`.`devolution_return_id` = `dr`.`id`'
            .'  );'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('UPDATE `devolution_system_product` SET `devolution_return_id` = NULL;');
        $this->addSql('UPDATE `devolution_return` SET `warehouse` = NULL, `region` = NULL, `devolution_reference` = NULL, `control_number` = NULL;');
    }

    public function isTransactional(): bool
    {
        return true;
    }
}
