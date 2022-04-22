<?php
declare(strict_types=1);

namespace App\Controller\Presenter;

use Twig\Environment;
use Twig\Extra\String\StringExtension;
use Twig\Loader\FilesystemLoader;

//to move to DI with factory
abstract class Twig
{
    protected function getTwig(): Environment
    {
        $loader = new FilesystemLoader();
        $loader->addPath(__DIR__ . '/../../View/');

        $twig = new Environment($loader);
        $twig->addExtension(new StringExtension());

        return $twig;
    }
}