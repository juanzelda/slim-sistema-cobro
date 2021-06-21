<?php

namespace App\Controllers;

use App\DAO\DescuentoDAO;
use App\Util\ApiResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DescuentoController
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

    public function generarDescuento(Request $req, Response $res,array $args)
    {
        $token = (object)$req->getAttribute("token");
        $id = DescuentoDAO::addDescuento($token->id,(object)$req->getParsedBody());
        return $this->successResponse($res, $id, 201);
    }

    public function getDescuentos(Request $req, Response $res,array $args)
    {
        return $this->successResponse($res, DescuentoDAO::getDescuentos($args['id']));
    }

    public function eliminarDescuento(Request $req, Response $res, array $args)
    {
        return $this->successResponse($res, DescuentoDAO::eliminarDescuento($args['id']));
    }
}
