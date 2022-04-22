<?php
declare(strict_types=1);

namespace App\Service;

use App\Command\AddUserCommand;
use App\Controller\ResourceNotFoundException;
use App\Repository\UserRepository;

final class UserService
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        //session handler for auth setting/check
    }

    public function loginUser(string $login, string $password): void
    {
        $user = $this->userRepository->getUser($login, $password);

        if (!$user) {
            throw new ResourceNotFoundException();
        }

        //create authenticated session
    }

    public function createUser(AddUserCommand $command): void
    {
        $this->userRepository->createAccount($command);
    }
}
