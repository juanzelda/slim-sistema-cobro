<?php

namespace App\DAO;

use App\Util\DataBase as DB;
use Envms\FluentPDO\Query as FluentPdo;
use \PDO;

// use App\Entity\Usuario;

class SecurityDAO
{

    public function __construct()
    {
    }

    public static function initSesion($p)
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare(
                "SELECT 
                       usuarios.id AS id_user,username,password,perfil.id AS id_perfil,perfil.perfil,
                       colaborador.id AS id_empleado,colaborador.nip,colaborador.foto,
                       personas.nombre,personas.paterno,personas.materno 
                 FROM usuarios 
                 INNER JOIN perfil ON usuarios.id_perfil=perfil.id
                 INNER JOIN colaborador ON usuarios.id_colaborador=colaborador.id
                 INNER JOIN personas ON colaborador.id_persona=personas.id 
                 WHERE username='admin' AND password='admin' AND usuarios.estatus=1"
            );
            $stm->bindParam(1, $p->usuario);
            $stm->bindParam(2, $p->password);
            $stm->execute();

            return $stm->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function buildMenu($id_perfil)
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare(
                "SELECT 
                      modulo.clave_router,
	                  modulo.modulo,
	                  modulo.path 
                 FROM modulo 
                 INNER JOIN modulo_perfil ON modulo.id=modulo_perfil.id_modulo
                 WHERE modulo_perfil.id_perfil=?"
            );
            $stm->bindParam(1, $id_perfil);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }
}
