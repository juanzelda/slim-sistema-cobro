<?php

namespace App\DAO;

use App\Util\DataBase as DB;
use PDO;

class ContribuyenteDAO
{

    public function __construct()
    {
    }

    public static function createContribuyente($p)
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


            $stm = $db->prepare("INSERT INTO contribuyente(id_persona,email,telefono) VALUES(?,?,?)");
            $stm->bindParam(1, $id_persona);
            $stm->bindParam(2, $p->email);
            $stm->bindParam(3, $p->telefono);
            $stm->execute();
            $id_contribuyente = $db->lastInsertId();

            $db->commit();
            return ["contribuyente" => $id_contribuyente, "persona" => $id_persona];
        } catch (\Throwable $th) {
            $db->rollBack();
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function getContribuyentes()
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare(
                "SELECT * FROM contribuyente 
            INNER JOIN personas ON contribuyente.id_persona=personas.id"
            );
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function getContribuyente($id)
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare("SELECT * FROM contribuyente 
            INNER JOIN personas ON contribuyente.id_persona=personas.id 
            WHERE contribuyente.id=?");
            $stm->bindParam(1, $id);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function updateContribuyente($id, $p)
    {

        try {
            $db = DB::getConnection();
            $db->beginTransaction();

            $stm = $db->prepare("UPDATE contribuyente SET email=?,telefono=? WHERE id=?");
            $stm->bindParam(1, $p->email);
            $stm->bindParam(2, $p->telefono);
            $stm->bindParam(3, $id);
            $stm->execute();
            $ok_Contribuyente = $stm->rowCount();

            $stm = $db->prepare("UPDATE personas SET nombre=?,paterno=?,materno=?,genero=?,fecha_nacimiento=? WHERE id=?");
            $stm->bindParam(1, $p->nombre);
            $stm->bindParam(2, $p->paterno);
            $stm->bindParam(3, $p->materno);
            $stm->bindParam(4, $p->genero);
            $stm->bindParam(5, $p->fecha_nacimiento);
            $stm->bindParam(6, $p->id_persona);
            $stm->execute();
            $ok_persona = $stm->rowCount();

            $db->commit();
            return ["contribuyente" => $ok_Contribuyente, "persona" => $ok_persona];
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function deleteContribuyente($id)
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare("UPDATE contribuyente SET estatus=0 WHERE id=?");
            $stm->bindParam(1, $id);
            $stm->execute();
            return $stm->rowCount();
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }
}
