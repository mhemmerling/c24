<?php
declare(strict_types=1);

namespace App\Repository;

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
}
