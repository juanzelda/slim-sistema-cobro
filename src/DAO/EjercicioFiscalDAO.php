<?php
namespace App\DAO;

use App\Entity\Perfil;

class EjercicioFiscalDAO
{

    public function __construct()
    {}

    public static function createPerfil($p)
    {

        $perfil = new Perfil();
        $perfil->perfil = $p->perfil;
        $perfil->descripcion = $p->descripcion;
        $perfil->save();

    }

    public static function getPerfiles()
    {
        return Perfil::all();
    }

}
