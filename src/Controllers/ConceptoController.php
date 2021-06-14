<?php

namespace App\Controllers;

use App\DAO\ConceptoDAO;
use App\Util\ApiResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ConceptoController
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

    public function createConcepto(Request $req, Response $res) //inicio de sesion
    {
        $id = ConceptoDAO::createConcepto((object)$req->getParsedBody());
        return $this->successResponse($res, ["id" => $id], 201);
    }

    public function getConceptos(Request $req, Response $res)
    {
        return $this->successResponse($res, ConceptoDAO::getConceptos());
    }

    public function getConceptosByDescripcionOrClave(Request $req, Response $res)
    {
        return $this->successResponse($res, ConceptoDAO::getConceptosByDescripcionOrClave((object)$req->getQueryParams()));
    }

    public function getConceptoId(Request $req, Response $res, array $args)
    {
        return $this->successResponse($res, ConceptoDAO::getConceptoId($args['id']));
    }

    public function updateConcepto(Request $req, Response $res, array $args)
    {
        $ok = ConceptoDAO::updateConcepto($args['id'], (object)$req->getParsedBody());
        return $this->successResponse($res, $ok);
    }

    public function deleteConcepto(Request $req, Response $res, array $args)
    {
        return $this->successResponse($res, ConceptoDAO::deleteConcepto($args['id']));
    }
}
