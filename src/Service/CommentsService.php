<?php
declare(strict_types=1);

namespace App\Service;

use App\Command\AddCommentCommand;
use App\Repository\CommentsRepository;

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

    public function addComment(AddCommentCommand $command)
    {
        $this->commentsRepository->addComment($command);
    }
}
