<?php

use App\Controller\HomeController;
use App\Http\Router;

return function (Router $router): void {
    $router->get('/', HomeController::class . "@index");
};
