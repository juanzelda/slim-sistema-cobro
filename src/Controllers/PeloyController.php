<?php

namespace App\Controllers;

use App\DAO\PeloyDAO;
use App\Util\AuthJWT;
use App\Util\ApiResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PeloyController
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

    public function addPeloy(Request $req, Response $res,$args)
    {
        $id = PeloyDAO::addPeloy((object)$req->getParsedBody());
        return $this->successResponse($res, ["id" => $id], 201);
    }

    public function getPeloy(Request $req, Response $res,$args)
    {
        
        return $this->successResponse($res, PeloyDAO::getPeloy());
    }

}
