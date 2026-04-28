<?php

namespace Middleware;

use Core\Builders\BadRequestBuilder;
use Core\Pipeline\AbstractMiddleware;
use Core\Request;
use Core\Response;

class NotFoundMiddleware extends AbstractMiddleware
{
    public function handle(Request $request): Response
    {
        return Response::redirect('/');
    }
}
