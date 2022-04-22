<?php
declare(strict_types=1);

namespace App\Repository;

use App\Command\AddUserCommand;

final class UserRepository
{
    private const USERS_TABLE = 'users';

    private Repository $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function getUser(string $login, string $password): ?array
    {
        $user = $this->repository->getDb()
            ->createQueryBuilder()
            ->select('users')
            ->where('name = ?')
            ->andWhere('password = ?')
            ->setParameter(0, $login)
            ->setParameter(1, $this->hashPassword($password))
            ->executeQuery()
            ->fetchAssociative();

        return $user ?? null;
    }

    public function createAccount(AddUserCommand $command): void
    {
        $this->repository->getDb()->insert(
            self::USERS_TABLE,
            [
                'name' => $command->getName(),
                'login' => $command->getEmail(),
                'password' => $this->hashPassword($command->getPassword())
            ]
        );
    }

    private function hashPassword(string $plainPassword): string
    {
        return password_hash($plainPassword, PASSWORD_BCRYPT_DEFAULT_COST);
    }
}
