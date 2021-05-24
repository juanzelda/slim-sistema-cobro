<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Util\AuthJWT;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as Res;

class SessionMiddleware implements Middleware
{
    /**
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        $token = $request->getHeaderLine("Authorization");
        try {
            AuthJWT::Check($token);
            $request = $request->withAttribute('token', AuthJWT::GetData($token));
            return $handler->handle($request);
        } catch (\Exception $e) {
            $response = new Res();
            $response->getBody()->write("Recurso no Autorizado...");
            return $response->withStatus(401);;
        }
    }
}
