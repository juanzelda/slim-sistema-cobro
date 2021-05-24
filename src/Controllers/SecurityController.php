<?php

namespace App\Controllers;

use App\DAO\SecurityDAO;
use App\Util\AuthJWT;
use App\Util\ApiResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SecurityController
{

    use ApiResponse;

    public function __construct()
    {
    }

    public function initSesion(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface //inicio de sesion
    {

        $data = SecurityDAO::initSesion((object) $request->getParsedBody());
        //return $this->successResponse($response, $data->materno);

        if ($data != null) {
            $data = (object)$data;
            $token = [
                "id" => $data->id_user,
                "perfil" => $data->id_perfil,
                "empleado" => $data->id_empleado,
                "nip" => $data->nip
            ];
            $dataResponse = [
                "perfil" => $data->perfil,
                "nip" => $data->nip,
                "foto" => $data->foto,
                "nombre" => $data->nombre,
                "paterno" => $data->paterno,
                "materno" => $data->materno
            ];
            return $this->successResponse($response, ["token" => AuthJWT::SignIn($token), "data" => $dataResponse]);
        } else {
            return "Error No Hay Usuario";
        }
    }

    public function buildMenu(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface //inicio de sesion
    {
        $token = $request->getAttribute("token");
        $data = SecurityDAO::buildMenu($token->perfil ?? 0);
        return $this->successResponse($response, $data);
    }
}
