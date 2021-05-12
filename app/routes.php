<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->group('/api',function(Group $group){
        
        $group->get('',function(Request $request,Response $response){
            $response->getBody()->write('Base Api');
            return $response;
        });

        foreach (glob(__DIR__."/routers/*.php") as $filename)
          {
              $router=require $filename;
              $router($group);   
          }
    });

};
