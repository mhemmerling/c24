<?php
declare(strict_types=1);

namespace App\Service;

use App\Repository\PostsRepository;

final class PostsService
{
    private PostsRepository $postsRepository;

    public function __construct(PostsRepository $postsRepository)
    {
        $this->postsRepository = $postsRepository;
    }

    public function getPostBySlug(string $slug): array
    {
        return $this->postsRepository->getPostBySlug($slug);
    }
}
