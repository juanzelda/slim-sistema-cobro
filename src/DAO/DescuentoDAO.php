<?php

namespace App\DAO;

use App\Util\DataBase as DB;
use PDO;

class DescuentoDAO
{

    public function __construct()
    {
    }

    public static function addDescuento($id, $p)
    {

        try {
            $db = DB::getConnection();
               $stm = $db->prepare("INSERT INTO descuento(id_cargo,persona_otorga,monto,motivo) VALUES(?,?,?,?);");
               $stm->bindParam(1, $p->id_cargo);
               $stm->bindParam(2, $id);
               $stm->bindParam(3, $p->monto);
               $stm->bindParam(4, $p->motivo);
               $stm->execute();
               $id_descuento = $db->lastInsertId();
               return ["id_descuento"=>$id_descuento];
            
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function getDescuentos($id)
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare("SELECT * FROM descuento WHERE id_cargo=?");
            $stm->bindParam(1, $id);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }


    public static function eliminarDescuento($id)
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare("DELETE FROM descuento WHERE id=?");
            $stm->bindParam(1, $id);
            $stm->execute();
            return $stm->rowCount();
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }
}
