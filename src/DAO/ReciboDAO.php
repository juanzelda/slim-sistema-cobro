<?php

namespace App\DAO;

use App\Util\DataBase as DB;
use \PDO;
use Carbon\Carbon;


class ReciboDAO
{

    public function __construct()
    {
    }


    public static function generarRecibo($p)
    {
        try {
            $cajero = 4; //se traera de token con el getatribute y es el id usuario en session 
            $folio = 2; // se saca econ consulta el ultimo folio 
            $db = DB::getConnection();
            $db->beginTransaction();
            $stm = $db->prepare("INSERT INTO recibo(id_contribuyente,folio,cajero) VALUES(?,?,?)");
            $stm->bindParam(1, $p->id_contribuyente);
            $stm->bindParam(2, $folio);
            $stm->bindParam(3, $cajero);
            $stm->execute();
            $id_recibo = $db->lastInsertId();

            $stm = $db->prepare("INSERT INTO cargo(id_recibo,id_concepto,clave,concepto,precio_unitario,cantidad,total) VALUES(?,?,?,?,?,?,?)");
            foreach ($p->cargos as $cargo) {
                $cargo = (object)$cargo;
                $stm->bindParam(1, $id_recibo);
                $stm->bindParam(2, $cargo->id_concepto);
                $stm->bindParam(3, $cargo->clave);
                $stm->bindParam(4, $cargo->concepto);
                $stm->bindParam(5, $cargo->precio_unitario);
                $stm->bindParam(6, $cargo->cantidad);
                $stm->bindParam(7, $cargo->total);
                $stm->execute();
            }

            $db->commit();
            return $id_recibo;
        } catch (\Throwable $th) {
            $db->rollBack();
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function getRecibos()
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare(
                "SELECT folio,fecha_creacion FROM recibo
                 INNER JOIN usuarios ON recibo.cajero=usuarios.id"
            );
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }
    public static function detalleRecibo($id)
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare("SELECT usuarios.id,username,GROUP_CONCAT(perfil.perfil) AS perfiles 
            FROM usuarios 
            INNER JOIN usuario_perfil ON usuarios.id=usuario_perfil.id_usuario
            INNER JOIN perfil ON usuario_perfil.id_perfil=perfil.id WHERE usuarios.id=? GROUP BY usuarios.id");
            $stm->bindParam(1, $id);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function eliminarRecibo($id)
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare("UPDATE usuarios SET estatus=0 WHERE id=?");
            $stm->bindParam(1, $id);
            $stm->execute();
            return $stm->rowCount();
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }
}
