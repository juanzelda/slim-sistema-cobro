<?php

namespace App\Controllers;

use App\DAO\EjercicioFiscalDAO;
use App\Util\AuthJWT;
use App\Util\ApiResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class EjercicioFiscalController
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

    public function createEjercicioFiscal(Request $req, Response $res) //inicio de sesion
    {
        $id = EjercicioFiscalDAO::createEjercicioFiscal((object)$req->getParsedBody());
        return $this->successResponse($res, ["id" => $id], 201);
    }

    public function getEjercicioFiscales(Request $req, Response $res)
    {
        return $this->successResponse($res, EjercicioFiscalDAO::getEjercicioFiscales());
    }

    public function getEjercicioFiscal(Request $req, Response $res, array $args)
    {
        return $this->successResponse($res, EjercicioFiscalDAO::getEjercicioFiscal($args['id']));
    }

    public function updateEjercicioFiscal(Request $req, Response $res, array $args)
    {
        $ok = EjercicioFiscalDAO::updateEjercicioFiscal($args['id'], (object)$req->getParsedBody());
        return $this->successResponse($res, $ok);
    }

    public function deleteEjercicioFiscal(Request $req, Response $res, array $args)
    {
        return $this->successResponse($res, EjercicioFiscalDAO::deleteEjercicioFiscal($args['id']));
    }
}
