<?php
declare(strict_types=1);

namespace App\Repository;

final class PostsRepository
{
    private const POSTS_TABLE = 'posts';
    private const COMMENTS_TABLE = 'comments';

    private Repository $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function getPosts($limit = 10, $offset = 0, $sortColumn = 'created_at', $sortOrder = 'DESC'): ?array
    {
        $posts = [];
        $result = $this->repository->getDb()
            ->createQueryBuilder()
            ->select('p.*', 'count(c.id) as comments_count')
            ->from(self::POSTS_TABLE, 'p')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->addOrderBy($sortColumn, $sortOrder)
            ->leftJoin('p', self::COMMENTS_TABLE, 'c', 'p.id = c.post_id')
            ->groupBy('p.id')
            ->executeQuery()
            ->fetchAllAssociative();

        foreach ($result as $post) {
            $posts[] = PostFactory::createFromDB($post);
        }

        return $posts;
    }

    public function getPostBySlug(string $slug): array
    {
        $post = $this->repository->getDb()
            ->createQueryBuilder()
            ->select('*')
            ->from(self::POSTS_TABLE)
            ->where('slug = ?')
            ->setParameter(0, $slug)
            ->executeQuery()
            ->fetchOne();

        return $post;

        //@todo throw not found
    }
}
