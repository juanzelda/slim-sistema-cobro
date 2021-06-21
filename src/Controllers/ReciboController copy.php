<?php

namespace App\Controllers;

use App\DAO\PagoDAO;
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
        $token = (object)$req->getAttribute('token');
        $id = PagoDAO::generarRecibo($token->id, (object)$req->getParsedBody());
        return $this->successResponse($res, ["id" => $id], 201);
    }
    public function getRecibos(Request $req, Response $res, array $args)
    {
        return $this->successResponse($res, PagoDAO::getRecibos($args['id']));
    }

    public function detalleRecibo(Request $req, Response $res, array $args)
    {
        return $this->successResponse($res, PagoDAO::detalleRecibo($args['folio']));
    }

    public function eliminarRecibo(Request $req, Response $res, array $args)
    {
        return $this->successResponse($res, PagoDAO::eliminarRecibo($args['id']));
    }
}
