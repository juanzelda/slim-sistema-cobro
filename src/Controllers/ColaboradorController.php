<?php

namespace App\Controllers;

use App\DAO\PerfilDAO;
use App\Util\AuthJWT;
use App\Util\ApiResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ColaboradorController
{
    use ApiResponse;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function createPerfil(Request $req, Response $res) //inicio de sesion
    {
       $data=PerfilDAO::createPerfil((object) $req->getParsedBody());
       return $this->successResponse($res,$data,201);
    }

    public function getPerfiles(Request $req, Response $res)
    {
        return $this->successResponse($res,PerfilDAO::getPerfiles());
    }

}
