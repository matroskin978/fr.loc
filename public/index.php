<?php

$start_framework = microtime(true);

if (PHP_MAJOR_VERSION < 8) {
    die('Require PHP version >= 8');
}

require_once __DIR__ . '/../config/config.php';
require_once ROOT . '/vendor/autoload.php';
require_once HELPERS . '/helpers.php';

$app = new \PHPFramework\Application();
require_once CONFIG . '/routes.php';
$app->run();

//dump("Time: " . microtime(true) - $start_framework);
