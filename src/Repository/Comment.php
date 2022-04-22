<?php
declare(strict_types=1);

namespace App\Repository;

final class Comment
{
    private int $id;
    private ?string $name;
    private ?string $email;
    private ?string $website;
    private string $content;
    private int $postId;
    private string $createdAt;

    public function __construct(
        int $id,
        ?string $name,
        ?string $email,
        ?string $website,
        string $content,
        int $postId,
        string $createdAt
    ) {

        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->website = $website;
        $this->content = $content;
        $this->postId = $postId;
        $this->createdAt = $createdAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
