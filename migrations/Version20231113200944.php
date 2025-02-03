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

final class Version20231113200944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update password for "user@nubity.com" and "admin@nubity.com" users.';
    }

    public function up(Schema $schema): void
    {
        foreach ($this->getUsers() as $email => $data) {
            $this->addSql(\sprintf('UPDATE user SET `password` = \'%s\' WHERE `email` = \'%s\';', $data['new_password'], $email));
        }
    }

    public function down(Schema $schema): void
    {
        foreach ($this->getUsers() as $email => $data) {
            $this->addSql(\sprintf('UPDATE user SET `password` = \'%s\' WHERE `email` = \'%s\';', $data['original_password'], $email));
        }
    }

    public function isTransactional(): bool
    {
        return true;
    }

    /**
     * @phpstan-return iterable<string, array{password: string}>
     */
    private function getUsers(): iterable
    {
        yield 'user@nubity.com' => [
            // "Bimbo!2023"
            'new_password' => '\$2y\$13$01gfeYZ9PoFZHqyEpItf8.hMZDCt5OQwx5s67rYZ6KCi89f9HyJhe',
            // "1234"
            'original_password' => '\$2y\$13\$t7SGauE8UxyTOqeREXlIG.UqZoldkvemepCllUEucJQ582d4Vy0qS',
        ];

        yield 'admin@nubity.com' => [
            // "Bimbo!2023"
            'new_password' => '\$2y\$13$01gfeYZ9PoFZHqyEpItf8.hMZDCt5OQwx5s67rYZ6KCi89f9HyJhe',
            // "1234"
            'original_password' => '\$2y\$13\$t7SGauE8UxyTOqeREXlIG.UqZoldkvemepCllUEucJQ582d4Vy0qS',
        ];
    }
}
