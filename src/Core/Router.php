<?php
declare(strict_types=1);

namespace App\Core;

use App\Controller\ErrorController;
use App\Controller\ResourceNotFoundException;
use App\Controller\Response;
use Throwable;

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
        [
            'path' => '/post/([A-Za-z0-9-_]+)',
            'controller' => \App\Controller\IndexController::class,
            'action' => 'singleAction',
            'httpMethods' => ['GET']
        ],
        [
            'path' => '/post/([A-Za-z0-9-_]+)/comment',
            'controller' => \App\Controller\IndexController::class,
            'action' => 'addCommentAction',
            'httpMethods' => ['POST']
        ],
        [
            'path' => '/login',
            'controller' => \App\Controller\UserController::class,
            'action' => 'loginFormAction',
            'httpMethods' => ['GET']
        ],
        [
            'path' => '/login',
            'controller' => \App\Controller\UserController::class,
            'action' => 'authorizeAction',
            'httpMethods' => ['POST']
        ],
    ];

    private ServiceContainer $container;
    private string $uriPath;
    private string $httpMethod;

    public function __construct(string $uriPath, ServiceContainer $container, string $httpMethod)
    {
        $this->container = $container;
        $this->uriPath = $uriPath;
        $this->httpMethod = $httpMethod;
    }

    /**
     * @throws ResourceNotFoundException
     * @throws Throwable
     * @return Response
     */
    public function getAction(): Response
    {
        foreach (self::ROUTES as $route) {
            if (preg_match('%^' . $route['path'] . '$%i', rtrim($this->uriPath), $args, PREG_UNMATCHED_AS_NULL) && in_array($this->httpMethod, $route['httpMethods'])) {
                $args = isset($args[1]) ? [$args[1]] : [];
                return ($this->container->get($route['controller']))
                    ->{$route['action']}(...$args);
            }
        }

        return (new ErrorController())->NotFoundAction();
    }
}
