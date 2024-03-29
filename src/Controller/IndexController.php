<?php
declare(strict_types=1);

namespace App\Controller;

use App\Command\AddCommentCommand;
use App\Controller\Presenter\IndexHomePresenter;
use App\Controller\Presenter\PostPresenter;
use App\Service\CommentsService;
use App\Service\PostsService;
use Throwable;

final class IndexController extends Controller
{
    private const POSTS_PER_PAGE = 3;

    private PostsService $postsService;
    private CommentsService $commentsService;

    public function __construct(PostsService $postsService, CommentsService $commentsService)
    {
        $this->postsService = $postsService;
        $this->commentsService = $commentsService;
    }

    public function homeAction(): Response
    {
        $page = 1; //@TODO with param
        return new IndexHomePresenter([
            'posts' => $this->postsService->getLatestPosts($page, self::POSTS_PER_PAGE)
        ]);
    }

    public function singleAction(string $slug): Response
    {
        try {
            $post = $this->postsService->getPostBySlug($slug);
            $comments = $this->commentsService->getPostComments($post->getId());

            return new PostPresenter([
                'post' => $post,
                'comments' => $comments,
            ]);
        } catch (Throwable $throwable) {
            throw new ResourceNotFoundException();
        }
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function addCommentAction(string $slug): Response
    {
        try {
            $post = $this->postsService->getPostBySlug($slug);
            $this->commentsService->addComment(
                new AddCommentCommand(
                    $post->getId(),
                    $_POST['name'],
                    $_POST['email'],
                    $_POST['url'],
                    $_POST['content']
                )
            );
        } catch (Throwable $throwable) {
            throw new ResourceNotFoundException();
        }

        return new RedirectResponse('/post/' . $slug);
    }
}
