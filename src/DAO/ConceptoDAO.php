<?php

namespace App\DAO;

use App\Util\DataBase as DB;
use \PDO;
use Carbon\Carbon;

class ConceptoDAO
{

    public function __construct()
    {
    }

    public static function Mayus($data)
    {
        return  mb_strtoupper($data, 'utf-8');
    }

    public static function Minus($data)
    {
        return  trim(mb_strtolower($data, 'utf-8'));
    }

    public static function createConcepto($p)
    {

        try {
            $db = DB::getConnection();
            $stm = $db->prepare("INSERT INTO concepto(clave,concepto,importe) VALUES(?,?,?)");
            $stm->bindParam(1, $p->clave);
            $stm->bindValue(2, self::Mayus($p->concepto));
            $stm->bindValue(3, round($p->importe, 2));
            $stm->execute();
            return $db->lastInsertId();
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
            return 0;
        }
    }

    public static function getConceptos()
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare("SELECT id,clave,concepto,importe,estatus FROM concepto");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function getConceptosByDescripcionOrClave($p)
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare("SELECT id,clave,concepto,importe FROM concepto WHERE concepto LIKE :search OR clave LIKE :search");
            $stm->bindValue(":search", "%" . self::Minus($p->search) . "%");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function getConceptoId($id)
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare("SELECT * FROM concepto WHERE id=?");
            $stm->bindParam(1, $id);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function updateConcepto($id, $p)
    {

        try {
            $date = "2020-01-01";
            $db = DB::getConnection();
            $stm = $db->prepare("UPDATE concepto SET clave=?,concepto=?,importe=? WHERE id=?");
            $stm->bindParam(1, $p->clave);
            $stm->bindValue(2, self::Mayus($p->concepto));
            $stm->bindValue(3, round($p->importe, 2));
            $stm->bindParam(4, $id);
            $stm->execute();
            return $stm->rowCount();
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function deleteConcepto($id)
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare("UPDATE concepto SET estatus=0 WHERE id=?");
            $stm->bindParam(1, $id);
            $stm->execute();
            return $stm->rowCount();
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }
}
