<?php

namespace App\Controllers;

use App\DAO\CargoDAO;
use App\Util\AuthJWT;
use App\Util\ApiResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CargoController
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

    public function addCargo(Request $req, Response $res,$args)
    {
        $id = CargoDAO::addCargo($args['id'],(object)$req->getParsedBody());
        return $this->successResponse($res, ["id" => $id], 201);
    }

    public function getCargos(Request $req, Response $res,$args)
    {
        return $this->successResponse($res, CargoDAO::getCargos($args['id']));
    }

    public function updateCargo(Request $req, Response $res, array $args)
    {
        $ok = CargoDAO::updateCargo($args['id'], (object)$req->getParsedBody());
        return $this->successResponse($res, $ok);
    }

    public function deleteCargo(Request $req, Response $res, array $args)
    {
        return $this->successResponse($res, CargoDAO::deleteCargo($args['id']));
    }
}
