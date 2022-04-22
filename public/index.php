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
    $router = new Router($_SERVER['REQUEST_URI'], $container, $_SERVER['REQUEST_METHOD']);
    echo $router->getAction()->view();
} catch (\App\Controller\ResourceNotFoundException $exception) {
    //logger
    echo (new ErrorPresenter(404, 'Page not found'))->view();
} catch (Throwable $throwable) {
    //logger
    echo (new ErrorPresenter(500, 'Whoops, something went wrong'))->view();
}
