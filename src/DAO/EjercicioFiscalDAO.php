<?php

namespace App\DAO;

use App\Util\DataBase as DB;
use PDO;

class EjercicioFiscalDAO
{

    public function __construct()
    {
    }

    public static function createEjercicioFiscal($p)
    {

        try {
            $db = DB::getConnection();

            $stm = $db->prepare("INSERT INTO ejercicio_fiscal(periodo,fecha_inicio,fecha_fin) VALUES(?,?,?)");
            $stm->bindParam(1, $p->periodo);
            $stm->bindParam(2, $p->fecha_inicio);
            $stm->bindParam(3, $p->fecha_fin);
            $stm->execute();
            $id_EjercicioFiscal = $db->lastInsertId();

            return $id_EjercicioFiscal;
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function getEjercicioFiscales()
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare("SELECT * FROM ejercicio_fiscal");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function getEjercicioFiscal($id)
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare("SELECT * FROM ejercicio_fiscal WHERE id=?");
            $stm->bindParam(1, $id);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function updateEjercicioFiscal($id, $p)
    {

        try {
            $db = DB::getConnection();

            $stm = $db->prepare("UPDATE ejercicio_fiscal SET periodo=?,fecha_inicio=?,fecha_fin=? WHERE id=?");
            $stm->bindParam(1, $p->periodo);
            $stm->bindParam(2, $p->fecha_inicio);
            $stm->bindParam(3, $p->fecha_fin);
            $stm->bindParam(4, $id);
            $stm->execute();
            $ok_ejercicioFiscal = $stm->rowCount();

            return $ok_ejercicioFiscal;
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function deleteEjercicioFiscal($id)
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare("UPDATE ejercicio_fiscal SET estatus=0 WHERE id=?");
            $stm->bindParam(1, $id);
            $stm->execute();
            return $stm->rowCount();
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }
}
