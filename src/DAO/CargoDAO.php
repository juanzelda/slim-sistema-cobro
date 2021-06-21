<?php

namespace App\DAO;

use App\Util\DataBase as DB;
use PDO;

class CargoDAO
{

    public function __construct()
    {
    }

    public static function addCargo($id, $p)
    {

        try {
            $db = DB::getConnection();
            $stm = $db->prepare("INSERT INTO cargo(id_recibo,id_concepto,clave,concepto,precio_unitario,cantidad,total) VALUES(?,?,?,?,?,?,?)");
            $stm->bindParam(1, $id);
            $stm->bindParam(2, $p->id_concepto);
            $stm->bindParam(3, $p->clave);
            $stm->bindParam(4, $p->concepto);
            $stm->bindParam(5, $p->precio_unitario);
            $stm->bindParam(6, $p->cantidad);
            $stm->bindParam(7, $p->total);
            $stm->execute();
            $id_cargo = $db->lastInsertId();
            return $id_cargo;
        } catch (\Throwable $th) {
            $db->rollBack();
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function getCargos($id)
    {
        try {
            $db = DB::getConnection();
<<<<<<< Updated upstream
            $stm = $db->prepare(
                "SELECT 
                       cargo.id,
                       clave,
                       concepto, 
                       ROUND(precio_unitario,2) AS precio_unitario,
                       cantidad, 
                       ROUND(IFNULL(monto,0),2) AS descuento, 
                       ROUND(total- IFNULL(monto,0),2) AS total
                FROM cargo
                LEFT JOIN descuento ON cargo.id=descuento.id_cargo
                WHERE cargo.id_recibo=?"
            );
=======
            $stm = $db->prepare("SELECT IFNULL(pago.id, 0) as id_pago, pago.monto as monto_pago,descuento.id as id_descuento,cargo.id as id_cargo,clave,concepto,precio_unitario,cantidad,total,descuento.monto FROM cargo 
            LEFT JOIN descuento ON cargo.id=descuento.id_cargo 
            LEFT JOIN pago ON cargo.id_recibo = pago.id_recibo
            WHERE cargo.id_recibo=?");
>>>>>>> Stashed changes
            $stm->bindParam(1, $id);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function updateCargo($id, $p)
    {

        try {
            $db = DB::getConnection();

            $stm = $db->prepare("UPDATE colaborador SET nip=?,rfc=?,puesto=?,email=?,foto=? WHERE id=?");
            $stm->bindParam(1, $p->nip);
            $stm->bindParam(2, $p->rfc);
            $stm->bindParam(3, $p->puesto);
            $stm->bindParam(4, $p->email);
            $stm->bindParam(5, $p->foto);
            $stm->bindParam(6, $id);
            $stm->execute();
            $ok_cargo = $stm->rowCount();

            return $ok_cargo;
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function deleteCargo($id)
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
