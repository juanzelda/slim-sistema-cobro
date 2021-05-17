<?php

namespace App\Controllers;

use App\DAO\ReciboDAO;
use App\Util\ApiResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ReciboController
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


    public function generarRecibo(Request $req, Response $res) //inicio de sesion
    {
        $id = ReciboDAO::generarRecibo((object)$req->getParsedBody());
        return $this->successResponse($res, ["id" => $id], 201);
    }
    public function getRecibos(Request $req, Response $res, array $args)
    {
        return $this->successResponse($res, ReciboDAO::getRecibos($args['id']));
    }

    public function detalleRecibo(Request $req, Response $res, array $args)
    {
        return $this->successResponse($res, ReciboDAO::detalleRecibo($args['folio']));
    }

    public function eliminarRecibo(Request $req, Response $res, array $args)
    {
        return $this->successResponse($res, ReciboDAO::eliminarRecibo($args['id']));
    }
}
