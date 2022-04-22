<?php
declare(strict_types=1);

namespace App\Service;

use App\Repository\Post;
use App\Repository\PostsRepository;

final class PostsService
{
    private PostsRepository $postsRepository;

    public function __construct(PostsRepository $postsRepository)
    {
        $this->postsRepository = $postsRepository;
    }

    public function getLatestPosts(int $page, int $perPage): array
    {
        $offset = $page * $perPage - $perPage;
        return $this->postsRepository->getPosts($perPage, $offset, 'created_at', 'desc');
    }

    public function getPostBySlug(string $slug): Post
    {
        return $this->postsRepository->getPostBySlug($slug);
    }
}
