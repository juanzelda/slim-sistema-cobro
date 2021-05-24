<?php

namespace App\Controllers;

use App\DAO\PerfilDAO;
use App\Util\ApiResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class PerfilController
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
        $ok = PerfilDAO::createPerfil((object)$req->getParsedBody());
        return $this->successResponse($res, $ok);
    }

    public function getPerfiles(Request $req, Response $res)
    {
        return $this->successResponse($res, PerfilDAO::getPerfiles());
    }

    public function getPerfil(Request $req, Response $res, array $args)
    {
        return $this->successResponse($res, PerfilDAO::getPerfil($args['id']));
    }

    public function updatePerfil(Request $req, Response $res, array $args)
    {
        $ok = PerfilDAO::updatePerfil($args['id'], (object)$req->getParsedBody());
        return $this->successResponse($res, $ok);
    }

    public function deletePerfil(Request $req, Response $res, array $args)
    {
        return $this->successResponse($res, PerfilDAO::deletePerfil($args['id']));
    }

    public function addModulos(Request $req, Response $res, array $args) //inicio de sesion
    {
        $ok = PerfilDAO::addModulos($args["id"], (object)$req->getParsedBody());
        return $this->successResponse($res, $ok);
    }
}
