<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\Presenter\IndexHomePresenter;

final class IndexController
{

    public function homeAction(): Response
    {
        return new IndexHomePresenter(
            [
                'posts' => []
            ]
        );
    }
}
