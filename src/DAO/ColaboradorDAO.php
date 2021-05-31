<?php

namespace App\DAO;

use App\Util\DataBase as DB;
use PDO;

class ColaboradorDAO
{

    public function __construct()
    {
    }

    public static function Mayus($data)
    {
        return  mb_strtoupper(trim($data), 'utf-8');
    }

    public static function Minus($data)
    {
        return  mb_strtolower(trim($data), 'utf-8');
    }


    public static function createColaborador($p)
    {

        try {
            $db = DB::getConnection();
            $db->beginTransaction();

            $stm = $db->prepare("INSERT INTO personas(nombre,paterno,materno,genero,fecha_nacimiento) VALUES(?,?,?,?,?)");
            $stm->bindValue(1, self::Mayus($p->nombre));
            $stm->bindValue(2, self::Mayus($p->paterno));
            $stm->bindValue(3, self::Mayus($p->materno));
            $stm->bindParam(4, $p->genero);
            $stm->bindParam(5, $p->fecha_nac);
            $stm->execute();
            $id_persona = $db->lastInsertId();

            $stm = $db->prepare("INSERT INTO direccion(id_persona,calle,colonia,num_ext,num_int,ciudad,estado) VALUES(?,?,?,?,?,?,?)");
            $stm->bindParam(1, $id_persona);
            $stm->bindValue(2, self::Mayus($p->calle));
            $stm->bindValue(3, self::Mayus($p->colonia));
            $stm->bindValue(4, self::Mayus($p->num_ext));
            $stm->bindValue(5, self::Mayus($p->num_int));
            $stm->bindValue(6, self::Mayus($p->ciudad));
            $stm->bindValue(7, self::Mayus($p->estado));
            $stm->execute();
            $id_direccion = $db->lastInsertId();

            $stm = $db->prepare("INSERT INTO colaborador(id_persona,nip,rfc,puesto,email,foto) VALUES(?,?,?,?,?,?)");
            $stm->bindParam(1, $id_persona);
            $stm->bindParam(2, $p->nip);
            $stm->bindValue(3, self::Mayus($p->rfc));
            $stm->bindValue(4, self::Mayus($p->puesto));
            $stm->bindValue(5, self::Minus($p->email));
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
                "SELECT colaborador.id,colaborador.id_persona,colaborador.nip,puesto,colaborador.estatus,nombre,paterno,materno,genero FROM colaborador 
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
            $stm = $db->prepare("SELECT colaborador.id,colaborador.id_persona,puesto,colaborador.estatus,nombre,paterno,materno,genero FROM colaborador 
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
            $stm->bindParam(2, self::Mayus($p->rfc));
            $stm->bindParam(3, self::Mayus($p->puesto));
            $stm->bindParam(4, self::Minus($p->email));
            $stm->bindParam(5, $p->foto);
            $stm->bindParam(6, $id);
            $stm->execute();
            $ok_colaborador = $stm->rowCount();

            $stm = $db->prepare("UPDATE personas SET nombre=?,paterno=?,materno=?,genero=?,fecha_nacimiento=? WHERE id=?");
            $stm->bindParam(1, self::Mayus($p->nombre));
            $stm->bindParam(2, self::Mayus($p->paterno));
            $stm->bindParam(3, self::Mayus($p->materno));
            $stm->bindParam(4, $p->genero);
            $stm->bindParam(5, $p->fecha_nacimiento);
            $stm->bindParam(6, $p->id_persona);
            $stm->execute();
            $ok_persona = $stm->rowCount();

            $stm = $db->prepare("UPDATE direccion SET calle=?,colonia=?,num_ext=?,num_int=?,ciudad=?,estado=? WHERE id=?");
            $stm->bindParam(1, self::Mayus($p->calle));
            $stm->bindParam(2, self::Mayus($p->colonia));
            $stm->bindParam(3, self::Mayus($p->num_ext));
            $stm->bindParam(4, self::Mayus($p->num_int));
            $stm->bindParam(5, self::Mayus($p->ciudad));
            $stm->bindParam(6, self::Mayus($p->estado));
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
