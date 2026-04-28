<?php

namespace Middleware;

use Core\Pipeline\AbstractMiddleware;
use Core\Request;
use Core\Response;
use UserContext;

class AuthMiddleware extends AbstractMiddleware
{
    public function handle(Request $request): Response
    {
       if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $uri = trim($request->uri, '/');
        $isAuthRoute = str_ends_with($uri, 'auth/login') || str_ends_with($uri, 'auth/register');

        if (!isset($_SESSION['user_id'])) {
            if ($isAuthRoute) {
                return parent::handle($request);
            }
            return Response::redirect('/auth/login');
        }

        $user = new UserContext($_SESSION['user_id'], $_SESSION['role'], $_SESSION['email'] ?? '');

        $request->setUserContext($user);

        return parent::handle($request);
    }
}
