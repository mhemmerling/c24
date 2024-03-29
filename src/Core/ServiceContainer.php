<?php
declare(strict_types=1);

namespace App\Core;

use App\Controller\IndexController;
use App\Controller\UserController;
use App\Repository\CommentsRepository;
use App\Repository\PostsRepository;
use App\Repository\UserRepository;
use App\Service\CommentsService;
use App\Service\PostsService;
use App\Repository\Repository;
use App\Service\UserService;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class ServiceContainer
{
    private ContainerBuilder $builder;

    public function __construct(ContainerBuilder $builder)
    {
        $this->builder = $builder;
    }

    //move content to yamls
    public function register()
    {
        $this->builder->setParameter(
            'mysql.credentials',
            [
                'dbname' => 'c24',
                'user' => 'root',
                'password' => 'somepass',
                'host' => '127.0.0.1',
                'driver' => 'pdo_mysql'
            ]
        );

        $this->builder->register(Repository::class, Repository::class)
            ->setArgument('dbCredentials', '%mysql.credentials%');

        $this->builder->register(PostsRepository::class, PostsRepository::class)
            ->setArgument('repository', $this->builder->get(Repository::class));

        $this->builder->register(PostsService::class, PostsService::class)
            ->setArgument('postsRepository', $this->builder->get(PostsRepository::class));

        $this->builder->register(CommentsRepository::class, CommentsRepository::class)
            ->setArgument('repository', $this->builder->get(Repository::class));

        $this->builder->register(CommentsService::class, CommentsService::class)
            ->setArgument('commentsRepository', $this->builder->get(CommentsRepository::class));

        $this->builder->register(IndexController::class, IndexController::class)
            ->setArgument('postsService', $this->builder->get(PostsService::class))
            ->setArgument('commentsService', $this->builder->get(CommentsService::class));

        $this->builder->register(UserRepository::class, UserRepository::class)
            ->setArgument('repository', $this->builder->get(Repository::class));

        $this->builder->register(UserService::class, UserService::class)
            ->setArgument('usersRepository', $this->builder->get(UserRepository::class));

        $this->builder->register(UserController::class, UserController::class)
            ->setArgument('userService', $this->builder->get(UserService::class));
    }

    public function get(string $id): ?object
    {
        return $this->builder->get($id);
    }

}
