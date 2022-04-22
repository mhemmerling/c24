<?php
declare(strict_types=1);

namespace App\Repository;

final class Post
{
    private int $id;
    private string $title;
    private string $slug;
    private string $content;
    private ?string $image;
    private string $createdAt;
    private string $authorName;
    private int $commentsCount;

    public function __construct(
        int $id,
        string $title,
        string $slug,
        string $content,
        ?string $image,
        string $createdAt,
        string $authorName,
        int $commentsCount
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->slug = $slug;
        $this->content = $content;
        $this->image = $image;
        $this->createdAt = $createdAt;
        $this->authorName = $authorName;
        $this->commentsCount = $commentsCount;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
