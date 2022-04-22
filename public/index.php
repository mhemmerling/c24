<?php
declare(strict_types=1);

include '../vendor/autoload.php';

use App\Controller\Presenter\ErrorPresenter;
use App\Core\Router;

try {
    $router = new Router($_SERVER['REQUEST_URI']);
    echo $router->getAction()->view();
} catch (Throwable $throwable) {
    //logger
    echo (new ErrorPresenter(500, 'Whoops, something went wrong'))->view();
}
