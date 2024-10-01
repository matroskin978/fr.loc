<?php

/** @var \PHPFramework\Application $app */

use App\Controllers\HomeController;
use App\Controllers\UserController;

const MIDDLEWARE = [
    'auth' => \PHPFramework\Middleware\Auth::class,
    'guest' => \PHPFramework\Middleware\Guest::class,
];

$app->router->get('/', [HomeController::class, 'index']);
$app->router->get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth']);
$app->router->get('/register', [UserController::class, 'register'])->middleware(['guest']);
$app->router->post('/register', [UserController::class, 'store'])->middleware(['guest']);
$app->router->get('/login', [UserController::class, 'login'])->middleware(['guest']);
$app->router->get('/users', [UserController::class, 'index']);


//dump(__FILE__ . __LINE__, $app->router->getRoutes());
