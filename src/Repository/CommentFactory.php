<?php
declare(strict_types=1);

namespace App\Repository;

final class CommentFactory
{
    public static function createFromDB(array $comment): Comment
    {
        return new Comment(
            (int)$comment['id'],
            $comment['name'],
            $comment['email'],
            $comment['website'],
            $comment['content'],
            (int)$comment['post_id'],
            $comment['created_at']
        );
    }
}
