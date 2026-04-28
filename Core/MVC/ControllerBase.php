<?php

namespace Core\MVC;

use Core\Response;

abstract class ControllerBase
{
    protected function view(string $viewName, array $data = [], int $statusCode = 200): Response
    {
        extract($data);

        ob_start();
        include __DIR__ . "/../../Views/$viewName.php";
        $content = ob_get_clean();

        ob_start();
        include __DIR__ . "/../../Views/layout.php";
        $fullHtml = ob_get_clean();

        return new Response($fullHtml, $statusCode);
    }

    protected function json(array $data, int $statusCode = 200): Response
    {
        $response = new Response(json_encode($data), $statusCode);
        $response->setHeader('Content-Type', 'application/json; charset=UTF-8');
        return $response;
    }

    protected function redirect(string $url): Response
    {
        return Response::redirect($url);
    }
}