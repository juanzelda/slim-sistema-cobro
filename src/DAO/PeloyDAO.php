<?php

namespace App\DAO;

use App\Util\DataBase as DB;
use PDO;

class PeloyDAO
{

    public function __construct()
    {
    }

    public static function addPeloy($p)
    {

        try {
            $db = DB::getConnection();
            $stm = $db->prepare("INSERT INTO peloy(peloycol) VALUES(?)");
            $stm->bindParam(1, $p->col);
            $stm->execute();
            $id_cargo = $db->lastInsertId();
            return $id_cargo;
        } catch (\Throwable $th) {
            
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function getPeloy()
    {

        try {
            $db = DB::getConnection();
            $stm = $db->prepare("SELECT peloycol  FROM peloy");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            
            return ["ErrorApi" => $th->getMessage()];
        }
    }

}
