<?php

declare(strict_types=1);

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Nyholm\Psr7\Response;

class HomeController
{
    public function index(ServerRequestInterface $request): Response
    {
        return new Response(200, ['Content-Type' => 'application/json'], json_encode([
            'message' => 'Bem-vindo à API de vídeos do YouTube!',
        ]));
    }
}
