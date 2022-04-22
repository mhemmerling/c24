<?php
declare(strict_types=1);

namespace App\Repository;

final class PostFactory
{
    public static function createFromDB(array $post): Post
    {
        return new Post(
            (int)$post['id'],
            $post['title'],
            $post['slug'],
            $post['content'],
            $post['image'],
            $post['created_at'],
            $post['author_name'] ?? '',
            (int)$post['comments_count']
        );
    }
}
