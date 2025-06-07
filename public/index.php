<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Http\Router;
use Nyholm\Psr7Server\ServerRequestCreator;
use Nyholm\Psr7\Factory\Psr17Factory;

$psr17Factory = new Psr17Factory();

$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$request = $creator->fromGlobals();

$containerBuilder = require __DIR__ . '/../config/container.php';
$container = $containerBuilder();

$router = new Router();

(require __DIR__ . '/../routes/routes.php')($router);

$response = $router->dispatch($request, $container);

http_response_code($response->getStatusCode());
foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}
echo $response->getBody();
