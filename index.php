<?php

require_once 'Core/autoload.php';
require_once 'Core/helpers.php';

use Controllers\AimController;
use Controllers\AuthController;
use Controllers\CategoryController;
use Controllers\HomeController;
use Controllers\SourceController;
use Controllers\TransactionController;
use Controllers\UserController;
use Core\App;
use Middleware\AuthMiddleware;
use Middleware\NotFoundMiddleware;
use Middleware\RouterMiddleware;
use Utils\Routing\RouteProvider;

$app = new App();

$routeProvider = new RouteProvider([
    HomeController::class,
    TransactionController::class,
    CategoryController::class,
    SourceController::class,
    AimController::class,
    UserController::class,
    AuthController::class,
]);

$app->use(new AuthMiddleware());
$app->use(new RouterMiddleware($routeProvider));
$app->use(new NotFoundMiddleware());

$app->run();
