<?php

$start_framework = microtime(true);

if (PHP_MAJOR_VERSION < 8) {
    die('Require PHP version >= 8');
}


var_dump("Time: " . microtime(true) - $start_framework);
