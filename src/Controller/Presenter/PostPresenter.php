<?php
declare(strict_types=1);

namespace App\Controller\Presenter;

use App\Controller\Response;

final class PostPresenter extends Twig implements Response
{
    private array $viewData;

    public function __construct($viewData)
    {
        $this->viewData = $viewData;
    }

    public function view(): string
    {
        return $this->getTwig()->render('Posts/single.html.twig', $this->viewData);
    }
}