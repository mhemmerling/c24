<?php
declare(strict_types=1);

namespace App\Repository;

final class PostsRepository
{
    private Repository $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function getPostBySlug(string $slug): array
    {
        return [];

        //@todo throw not found
    }
}
