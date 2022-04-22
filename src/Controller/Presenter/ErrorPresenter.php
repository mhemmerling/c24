<?php
declare(strict_types=1);

namespace App\Controller\Presenter;

use App\Controller\Response;

final class ErrorPresenter implements Response
{
    private int $code;
    private string $message;

    public function __construct(int $code, string $message)
    {
        $this->code = $code;
        $this->message = $message;
    }

    public function view(): string
    {
        http_response_code($this->code);

        return '<!DOCTYPE html>
            <html lang="en">
            <meta charset="UTF-8">
            <title>Error</title>
            <meta name="viewport" content="width=device-width,initial-scale=1">
            <body>
             <h1>' . $this->code . ' Error</h1>
             <p>' . $this->message . '</p>
            </body>
            </html>';
    }
}
