<?php

namespace App\Controllers;

use App\DAO\PersonaDAO;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class PersonaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }


    public function getPersonas(Request $req)
    {
        return PersonaDAO::getPersonas((object)$req->all());
    }

    public function getPersonaById($id)
    {

        return PersonaDAO::getPersonaById($id);
    }

    public function setPersona(Request $req)
    {
        $reglas = [
            /*persona*/
            "nombre" => "required", 
            "paterno" => "required", 
            "materno" => "required",
            "calle" => "required",
            "colonia" => "required",
            "num_ext" => "required",
            "telefono" => "required",
            "celular" => "required"
        ];
        $this->validate($req, $reglas);
        return PersonaDAO::setPersona((object)$req->all());
    }

    public function updatePersona($id, Request $req)
    {
        $reglas = [
            /*persona*/
            "nombre" => "required", "paterno" => "required", "materno" => "required"
        ];
        $this->validate($req, $reglas);
        return PersonaDAO::updatePersona($id, (object)$req->all());
    }

    public function deletePersona($id)
    {
        return PersonaDAO::deletePersona($id);
    }
}
