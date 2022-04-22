<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\Presenter\IndexHomePresenter;
use App\Controller\Presenter\PostPresenter;
use App\Service\PostsService;
use Throwable;

final class IndexController extends Controller
{
    private PostsService $postsService;

    public function __construct(PostsService $postsService)
    {
        $this->postsService = $postsService;
    }

    public function homeAction(): Response
    {
        return new IndexHomePresenter([
            'posts' => []
        ]);
    }

    public function singleAction(string $slug): Response
    {
        try {
            $post = $this->postsService->getPostBySlug($slug);
        } catch (Throwable $throwable) {
            //@todo notfoundexception
        }

        return new PostPresenter([
            'post' => []
        ]);
    }
}
