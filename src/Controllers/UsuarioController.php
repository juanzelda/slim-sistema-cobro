<?php

namespace App\Controllers;

use App\DAO\UsuarioDAO;
use App\Util\ApiResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UsuarioController
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


    public function createUser(Request $req, Response $res) //inicio de sesion
    {
        $id = UsuarioDAO::createUser((object)$req->getParsedBody());
        return $this->successResponse($res, ["id" => $id], 201);
    }
    public function getUsuarios(Request $req, Response $res)
    {
        return $this->successResponse($res, UsuarioDAO::getUsuarios());
    }

    public function getUsuario(Request $req, Response $res, array $args)
    {
        return $this->successResponse($res, UsuarioDAO::getUsuario($args['id']));
    }

    public function updateUsuario(Request $req, Response $res, array $args)
    {
        $ok = UsuarioDAO::updateUsuario($args['id'], (object)$req->getParsedBody());
        return $this->successResponse($res, $ok);
    }

    public function deleteUsuario(Request $req, Response $res, array $args)
    {
        return $this->successResponse($res, UsuarioDAO::deleteUsuario($args['id']));
    }

    public function addPerfil($id, Request $req)
    {
        //return UsuarioDAO::addPerfil($id, (object)$req->all());
    }
}
