<?php

namespace App\DAO;

use App\Util\DataBase as DB;
use PDO;

class PagoDAO
{

    public function __construct()
    {
    }

    public static function createColaborador($p)
    {

        try {
            $db = DB::getConnection();
            $db->beginTransaction();

            $stm = $db->prepare("INSERT INTO personas(nombre,paterno,materno,genero,fecha_nacimiento) VALUES(?,?,?,?,?)");
            $stm->bindParam(1, $p->nombre);
            $stm->bindParam(2, $p->paterno);
            $stm->bindParam(3, $p->materno);
            $stm->bindParam(4, $p->genero);
            $stm->bindParam(5, $p->fecha_nac);
            $stm->execute();
            $id_persona = $db->lastInsertId();

            $stm = $db->prepare("INSERT INTO direccion(id_persona,calle,colonia,num_ext,num_int,ciudad,estado) VALUES(?,?,?,?,?,?,?)");
            $stm->bindParam(1, $id_persona);
            $stm->bindParam(2, $p->calle);
            $stm->bindParam(3, $p->colonia);
            $stm->bindParam(4, $p->num_ext);
            $stm->bindParam(5, $p->num_int);
            $stm->bindParam(6, $p->ciudad);
            $stm->bindParam(7, $p->estado);
            $stm->execute();
            $id_direccion = $db->lastInsertId();

            $stm = $db->prepare("INSERT INTO colaborador(id_persona,nip,rfc,puesto,email,foto) VALUES(?,?,?,?,?,?)");
            $stm->bindParam(1, $id_persona);
            $stm->bindParam(2, $p->nip);
            $stm->bindParam(3, $p->rfc);
            $stm->bindParam(4, $p->puesto);
            $stm->bindParam(5, $p->email);
            $stm->bindParam(6, $p->foto);
            $stm->execute();
            $id_colaborador = $db->lastInsertId();

            $db->commit();
            return ["colaborador" => $id_colaborador, "persona" => $id_persona, "direccion" => $id_direccion];
        } catch (\Throwable $th) {
            $db->rollBack();
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function getColaboradores()
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare(
                "SELECT * FROM colaborador 
            INNER JOIN personas ON colaborador.id_persona=personas.id 
            INNER JOIN direccion ON personas.id=direccion.id_persona"
            );
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function getColaborador($id)
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare("SELECT * FROM colaborador 
            INNER JOIN personas ON colaborador.id_persona=personas.id 
            INNER JOIN direccion ON personas.id=direccion.id_persona WHERE colaborador.id=?");
            $stm->bindParam(1, $id);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function updateColaborador($id, $p)
    {

        try {
            $db = DB::getConnection();
            $db->beginTransaction();

            $stm = $db->prepare("UPDATE colaborador SET nip=?,rfc=?,puesto=?,email=?,foto=? WHERE id=?");
            $stm->bindParam(1, $p->nip);
            $stm->bindParam(2, $p->rfc);
            $stm->bindParam(3, $p->puesto);
            $stm->bindParam(4, $p->email);
            $stm->bindParam(5, $p->foto);
            $stm->bindParam(6, $id);
            $stm->execute();
            $ok_colaborador = $stm->rowCount();

            $stm = $db->prepare("UPDATE personas SET nombre=?,paterno=?,materno=?,genero=?,fecha_nacimiento=? WHERE id=?");
            $stm->bindParam(1, $p->nombre);
            $stm->bindParam(2, $p->paterno);
            $stm->bindParam(3, $p->materno);
            $stm->bindParam(4, $p->genero);
            $stm->bindParam(5, $p->fecha_nacimiento);
            $stm->bindParam(6, $p->id_persona);
            $stm->execute();
            $ok_persona = $stm->rowCount();

            $stm = $db->prepare("UPDATE direccion SET calle=?,colonia=?,num_ext=?,num_int=?,ciudad=?,estado=? WHERE id=?");
            $stm->bindParam(1, $p->calle);
            $stm->bindParam(2, $p->colonia);
            $stm->bindParam(3, $p->num_ext);
            $stm->bindParam(4, $p->num_int);
            $stm->bindParam(5, $p->ciudad);
            $stm->bindParam(6, $p->estado);
            $stm->bindParam(7, $p->id_direccion);
            $stm->execute();
            $ok_direccion = $stm->rowCount();

            $db->commit();
            return ["colaborador" => $ok_colaborador, "persona" => $ok_persona, "direccion" => $ok_direccion];
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function deleteColaborador($id)
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare("UPDATE colaborador SET estatus=0 WHERE id=?");
            $stm->bindParam(1, $id);
            $stm->execute();
            return $stm->rowCount();
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }
}
