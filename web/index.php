<?php

require(__DIR__ . '/../vendor/autoload.php');

$app = new \Silex\Application;
$app['debug'] = true;

if ($app['debug']) {
    $app->register(new Whoops\Provider\Silex\WhoopsServiceProvider);
}

$app->get('/', function() {
    return "<h1>Hello World</h1>";
});

$app->get('/info', function() {
    ob_start();
    phpinfo();

    return ob_get_clean();
});

# Produce a test error for the log
$app->get('/error', function() {
    trigger_error("Test Error!", E_USER_ERROR);
});

$app->run();
