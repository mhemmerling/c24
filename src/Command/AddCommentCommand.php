<?php
declare(strict_types=1);

namespace App\Command;

final class AddCommentCommand
{
    private int $postId;
    private string $name;
    private ?string $email;
    private ?string $url;
    private string $content;

    public function __construct(
        int $postId,
        string $name,
        ?string $email,
        ?string $url,
        string $content
    ) {
        $this->postId = $postId;
        $this->name = $name;
        $this->email = $email;
        $this->url = $url;
        $this->content = $content;
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}