<?php
declare(strict_types=1);

namespace App\Repository;

use App\Command\AddCommentCommand;

final class CommentsRepository
{
    private const COMMENTS_TABLE = 'comments';

    private Repository $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function getPostComments(int $postId): ?array
    {
        $comments = [];
        $result = $this->repository->getDb()
            ->createQueryBuilder()
            ->select('*')
            ->from(self::COMMENTS_TABLE)
            ->where('post_id = ?')
            ->setParameter(0, $postId)
            ->addOrderBy('created_at', 'desc')
            ->executeQuery()
            ->fetchAllAssociative();

        foreach ($result as $comment) {
            $comments[] = CommentFactory::createFromDB($comment);
        }

        return $comments;
    }

    public function addComment(AddCommentCommand $command): void
    {
        $this->repository->getDb()->insert(
            self::COMMENTS_TABLE,
            [
                'post_id' => $command->getPostId(),
                'name' => $command->getName(),
                'email' => $command->getEmail(),
                'website' => $command->getUrl(),
                'content' => $command->getContent()
            ]
        );
    }
}
