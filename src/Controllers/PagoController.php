<?php

namespace App\Controllers;

use App\DAO\PagoDAO;
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

    public function addPago(Request $req, Response $res,array $args)
    {
        $id = PagoDAO::addPago($args['id'],(object)$req->getParsedBody());
        return $this->successResponse($res, $id, 201);
    }

    public function getColaboradores(Request $req, Response $res)
    {
        return $this->successResponse($res, PagoDAO::getColaboradores());
    }

    public function getColaborador(Request $req, Response $res, array $args)
    {
        return $this->successResponse($res, PagoDAO::getColaborador($args['id']));
    }

    public function updateColaborador(Request $req, Response $res, array $args)
    {
        $ok = PagoDAO::updateColaborador($args['id'], (object)$req->getParsedBody());
        return $this->successResponse($res, $ok);
    }

    public function deleteColaborador(Request $req, Response $res, array $args)
    {
        return $this->successResponse($res, PagoDAO::deleteColaborador($args['id']));
    }
}
