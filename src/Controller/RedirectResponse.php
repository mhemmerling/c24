<?php
declare(strict_types=1);

namespace App\Controller;

final class RedirectResponse implements Response
{
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function view(): string
    {
        header('Location: ' . $this->url);
        return '';
    }
}