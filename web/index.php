<?php

require(__DIR__ . '/../vendor/autoload.php');

$app = new \Silex\Application;
$app->get('/', function() {
    return "<h1>Hello World</h1>";
});

$app->get('/info', function() {
    ob_start();
    phpinfo();

    return ob_get_clean();
});

$app->run();
