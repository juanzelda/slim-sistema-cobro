<?php

namespace App\Controllers;

use App\DAO\PerfilDAO;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class ContribuyenteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function createPerfil(Request $req) //inicio de sesion

    {
        $reglas = [
            /*perfil*/
            "perfil" => "required",
            "descripcion" => "required",
        ];
        $this->validate($req, $reglas);
        return PerfilDAO::createPerfil((object) $req->all());
    }

    public function getPerfiles()
    {
        return PerfilDAO::getPerfiles();
    }

}
