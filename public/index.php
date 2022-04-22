<?php
declare(strict_types=1);

include '../vendor/autoload.php';

use App\Controller\Presenter\ErrorPresenter;
use App\Core\Router;
use App\Core\ServiceContainer;
use Symfony\Component\DependencyInjection\ContainerBuilder;


$container = new ServiceContainer(new ContainerBuilder());
$container->register();

try {
    $router = new Router($_SERVER['REQUEST_URI'], $container);
    echo $router->getAction()->view();
} catch (Throwable $throwable) {
    //logger
    var_dump($throwable->getLine(), $throwable->getFile(), $throwable->getMessage());
    echo (new ErrorPresenter(500, 'Whoops, something went wrong'))->view();
}
