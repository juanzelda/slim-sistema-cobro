<?php

namespace App\Controllers;

use App\DAO\SecurityDAO;
use App\Util\AuthJWT;
use App\Util\ApiResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SecurityController
{

    use ApiResponse;

    public function __construct()
    {
    }

    public function initSesion(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface//inicio de sesion
    {

        $data = SecurityDAO::initSesion((object) $request->getParsedBody());
        
        if ($data != null) {
               return $this->successResponse($response,["token"=>AuthJWT::SignIn($data)]);
            } 
        else {
                    return "Error No Hay Usuario";
            }
                
            }

}
