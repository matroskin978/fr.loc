<?php

/** @var \PHPFramework\Application $app */

$app->router->add('/', function () {
    return 'Hello from home';
}, ['post', 'get']);

$app->router->get('test', [\App\Controllers\HomeController::class, 'test']);
$app->router->post('/contact/', [\App\Controllers\ContactController::class, 'test']);

dump($app->router->getRoutes());
