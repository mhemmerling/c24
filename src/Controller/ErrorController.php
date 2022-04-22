<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\Presenter\ErrorPresenter;

final class ErrorController extends Controller
{
    public function NotFoundAction(): Response
    {
        return new ErrorPresenter(404, 'Page not found');
    }
}
