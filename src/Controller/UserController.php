<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\UserService;

final class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function createAccountAction(): Response
    {
        //todo flash message - account created, you can now log in
        return new RedirectResponse('/');
    }

    //get action, form view
    public function loginFormAction(): Response
    {

    }

    //post action
    public function authorizeAction(): Response
    {
        try {
            $this->userService->loginUser($_POST['login'], $_POST['password']);
            //todo flash message - you are now logged in
            return new RedirectResponse('/');
        } catch (ResourceNotFoundException $exception) {
            //todo flash message - invalid credentials
            return new RedirectResponse('/login');
        }
    }
}
