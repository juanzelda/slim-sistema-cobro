<?php

namespace App\Controllers;

use App\DAO\ColaboradorDAO;
use App\Util\AuthJWT;
use App\Util\ApiResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PagoController
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

    public function createColaborador(Request $req, Response $res) //inicio de sesion
    {
        $id = ColaboradorDAO::createColaborador((object)$req->getParsedBody());
        return $this->successResponse($res, ["id" => $id], 201);
    }

    public function getColaboradores(Request $req, Response $res)
    {
        return $this->successResponse($res, ColaboradorDAO::getColaboradores());
    }

    public function getColaborador(Request $req, Response $res, array $args)
    {
        return $this->successResponse($res, ColaboradorDAO::getColaborador($args['id']));
    }

    public function updateColaborador(Request $req, Response $res, array $args)
    {
        $ok = ColaboradorDAO::updateColaborador($args['id'], (object)$req->getParsedBody());
        return $this->successResponse($res, $ok);
    }

    public function deleteColaborador(Request $req, Response $res, array $args)
    {
        return $this->successResponse($res, ColaboradorDAO::deleteColaborador($args['id']));
    }
}
