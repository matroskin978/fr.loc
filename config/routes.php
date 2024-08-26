<?php

/** @var \PHPFramework\Application $app */

$app->router->get('/', [\App\Controllers\HomeController::class, 'index']);

//$app->router->get('test', [\App\Controllers\HomeController::class, 'test']);
//$app->router->post('/contact/', [\App\Controllers\HomeController::class, 'contact']);

$app->router->get('/post/(?P<slug>[a-z0-9-]+)/?', function () {
    return '<p>Some post</p>';
});

//dump($app->router->getRoutes());
