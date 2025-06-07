<?php

declare(strict_types=1);

namespace App\Http;

use Nyholm\Psr7\Response;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Router
{
    private array $routes = [];

    public function get(string $path, string $handler): void
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, string $handler): void
    {
        $this->addRoute('POST', $path, $handler);
    }

    private function addRoute(string $method, string $path, string $handler): void
    {
        $this->routes[$method][$path] = $handler;
    }

    public function dispatch(ServerRequestInterface $request, ContainerInterface $container): ResponseInterface
    {
        $method = $request->getMethod();
        $path = $request->getUri()->getPath();

        $handler = $this->routes[$method][$path] ?? null;

        if (!$handler) {
            return new Response(404, [], 'Not Found');
        }

        [$controllerClass, $method] = explode('@', $handler);

        $controller = $container->get($controllerClass);

        return $controller->$method($request);
    }
}
