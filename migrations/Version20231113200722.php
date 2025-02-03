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

final class Version20231113200722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add users for environment "300".';
    }

    public function up(Schema $schema): void
    {
        foreach ($this->getUsers() as $email => $data) {
            $this->addSql(\sprintf('INSERT INTO user (`email`, `roles`, `locale`, `password`, `created_at`) VALUES (\'%s\', \'["%s"]\', \'es_MX\', \'%s\', NOW());', $email, $data['role'], $data['password']));
        }
    }

    public function down(Schema $schema): void
    {
        foreach ($this->getUsers() as $email => $data) {
            $this->addSql(\sprintf('DELETE FROM user WHERE `email` = \'%s\';', $email));
        }
    }

    public function isTransactional(): bool
    {
        return true;
    }

    /**
     * @phpstan-return iterable<string, array{password: string, role: string}>
     */
    private function getUsers(): iterable
    {
        yield 'despacho@grupobimbo.com' => [
            // "d35p4ch0"
            'password' => '$2y$13$ahozz4r9z/03SCk0Bu9urO8w7fyw02tl2mb.E2tSOf9vcw1UhwMYG',
            'role' => 'ROLE_ADMIN',
        ];

        yield 'ventas@grupobimbo.com' => [
            // "v3nd3d0r"
            'password' => '$2y$13$qLiSj.k4u.yL2NIIPSCfDeoFXlt0wt3NSaxxwStTpMKY8bG4CRzau',
            'role' => 'ROLE_ADMIN',
        ];

        yield 'control@grupobimbo.com' => [
            // "adm1n1str4d0r"
            'password' => '$2y$13$OQnfpWr3mV69dVoNTAp43exfvphrDW/5A7.mqbzkpZCZx/jlUTTh6',
            'role' => 'ROLE_ADMIN',
        ];

        yield 'soporte@gbsupport.net' => [
            // "l30p0ld0"
            'password' => '$2y$13$cRZP7hlNU6TcSgexLUTWUOFh.z7oT5SKWTclUuTB5ET4RHGxaNVYW',
            'role' => 'ROLE_ADMIN',
        ];
    }
}
