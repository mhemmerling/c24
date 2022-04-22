<?php
declare(strict_types=1);

namespace App\Service;

use App\Repository\CommentsRepository;
use App\Repository\Post;
use App\Repository\PostsRepository;

final class CommentsService
{
    private CommentsRepository $commentsRepository;

    public function __construct(CommentsRepository $commentsRepository)
    {
        $this->commentsRepository = $commentsRepository;
    }

    public function getPostComments(int $postId): array
    {
        return $this->commentsRepository->getPostComments($postId);
    }
}
