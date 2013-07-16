<?php

require(__DIR__ . '/../vendor/autoload.php');

$app = new \Silex\Application;
$app['debug'] = true;

if ($app['debug']) {
    $app->register(new Whoops\Provider\Silex\WhoopsServiceProvider);
}

$app->register(new CHH\Silex\CacheServiceProvider, [
    'cache.options' => [
        'default' => ['driver' => 'apc']
    ]
]);

$app->get('/', function() use ($app) {

    return "<h1>Hello World</h1>";
});

$app->get('/apc/{value}', function ($value) use ($app) {
    apcu_store('val', $value);
    return "<p>Value stored</p>";
});

$app->get('/apc', function () use ($app) {
    $value = apcu_fetch('val');

    $html = '';
    $html .= '<h1>APC test</h1>';
    $html .= "<p>Value: <code>$value</code></p>";

    return $html;
});

$app->get('/info', function () {
    ob_start();
    phpinfo();

    return ob_get_clean();
});

# Produce a test error for the log
$app->get('/error', function() {
    trigger_error("Test Error!", E_USER_ERROR);
});

$app->run();
