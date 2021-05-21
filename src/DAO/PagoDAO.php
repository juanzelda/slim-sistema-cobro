<?php

namespace App\DAO;

use App\Util\DataBase as DB;
use PDO;

class PagoDAO
{

    public function __construct()
    {
    }

    public static function addPago($id,$p)
    {

        try {
            $db = DB::getConnection();

            $stm = $db->prepare("SELECT (SELECT SUM(total) FROM cargo WHERE id_recibo=:id_recibo)-(SELECT IFNULL(SUM(monto),0) FROM pago WHERE id_recibo=:id_recibo) AS total");
            $stm->bindParam(':id_recibo', $id);
            $stm->execute();
            $saldo=$stm->fetchColumn(0);//obtine la columna 1 en este caso es esa

            if($saldo!=null && $p->monto<=$saldo && $saldo>0){
               $stm = $db->prepare("INSERT INTO pago(id_recibo,cajero_cobro,monto,forma_pago) VALUES(?,?,?,?);");
               $stm->bindParam(1, $id);
               $stm->bindParam(2, $p->cajero);
               $stm->bindParam(3, $p->monto);
               $stm->bindParam(4, $p->forma_pago);
               $stm->execute();
               $id_pago = $db->lastInsertId();
               return ["id_pago"=>$id_pago,"saldo_pendiente"=>($saldo-$p->monto)];
            }
            else{
                return ["id_pago"=>0,"saldo_pendiente"=>$saldo];
            }
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function getPagos($id)
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare("SELECT fecha_cobro,monto,forma_pago FROM pago WHERE id_recibo=?");
            $stm->bindParam(1, $id);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }


    public static function eliminarPago($id)
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare("DELETE FROM pago WHERE id=?");
            $stm->bindParam(1, $id);
            $stm->execute();
            return $stm->rowCount();
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }
}
