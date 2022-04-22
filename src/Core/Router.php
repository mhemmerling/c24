<?php
declare(strict_types=1);

namespace App\Core;

use App\Controller\ErrorController;
use App\Controller\Response;

/**
 * I didn't use library to develop anything myself :)
 */
final class Router
{
    //I would move it to yaml files or separate VO collection
    private const ROUTES = [
        [
            'path' => '/',
            'controller' => \App\Controller\IndexController::class,
            'action' => 'homeAction',
            'httpMethods' => ['GET']
        ],
    ];

    private ServiceContainer $container;
    private string $uriPath;

    public function __construct(string $uriPath, ServiceContainer $container)
    {
        $this->container = $container;
        $this->uriPath = $uriPath;
    }

    public function getAction(): Response
    {
        foreach (self::ROUTES as $route) {
            if (preg_match('%^' . $route['path'] . '$%i', rtrim($this->uriPath))) {
                //@todo pass arguments like slug etc.
                return ($this->container->get($route['controller']))->{$route['action']}();
            }
        }

        return (new ErrorController())->NotFoundAction();
    }
}
