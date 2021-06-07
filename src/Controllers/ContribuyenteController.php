<?php

namespace App\Controllers;

use App\DAO\ContribuyenteDAO;
use App\Util\AuthJWT;
use App\Util\ApiResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ContribuyenteController
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

    public function createContribuyente(Request $req, Response $res) //inicio de sesion
    {
        $id = ContribuyenteDAO::createContribuyente((object)$req->getParsedBody());
        return $this->successResponse($res, ["id" => $id], 201);
    }

    public function getContribuyentes(Request $req, Response $res)
    {
        return $this->successResponse($res, ContribuyenteDAO::getContribuyentes());
    }

    public function getContribuyente(Request $req, Response $res, array $args)
    {
        return $this->successResponse($res, ContribuyenteDAO::getContribuyente($args['id']));
    }

    public function updateContribuyente(Request $req, Response $res, array $args)
    {
        $ok = ContribuyenteDAO::updateContribuyente($args['id'], (object)$req->getParsedBody());
        return $this->successResponse($res, $ok);
    }

    public function deleteContribuyente(Request $req, Response $res, array $args)
    {
        return $this->successResponse($res, ContribuyenteDAO::deleteContribuyente($args['id']));
    }

    public function findContribuyenteByNameOrId(Request $req, Response $res, array $args)
    {
        return  $this->successResponse($res, ContribuyenteDAO::findContribuyenteByNameOrId((object)$req->getQueryParams()));
    }
}
