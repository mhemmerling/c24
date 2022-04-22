<?php
declare(strict_types=1);

namespace App\Controller\Presenter;

use App\Controller\Response;

final class IndexHomePresenter extends Twig implements Response
{
    private array $viewData;

    public function __construct(array $viewData)
    {
        $this->viewData = $viewData;
    }

    public function view(): string
    {
        return $this->getTwig()->render('Posts/list.html.twig', $this->viewData);
    }
}