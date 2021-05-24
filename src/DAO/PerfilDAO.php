<?php

namespace App\DAO;

use App\Util\DataBase as DB;
use \PDO;
use Carbon\Carbon;


class PerfilDAO
{

   public function __construct()
   {
   }


   public static function createPerfil($p)
   {
      try {
         $db = DB::getConnection();
         $stm = $db->prepare("INSERT INTO perfil(perfil,descripcion) VALUES(?,?)");
         $stm->bindParam(1, $p->perfil, PDO::PARAM_STR);
         $stm->bindParam(2, $p->descripcion, PDO::PARAM_STR);
         $stm->execute();
         return $db->lastInsertId();
      } catch (\Throwable $th) {
         return ["ErrorApi" => $th->getMessage()];
      }
   }

   public static function getPerfiles()
   {
      try {
         $db = DB::getConnection();
         $stm = $db->prepare("SELECT * FROM perfil");
         $stm->execute();
         return $stm->fetchAll(PDO::FETCH_ASSOC);
      } catch (\Throwable $th) {
         return ["ErrorApi" => $th->getMessage()];
      }
   }
   public static function getPerfil($id)
   {
      try {
         $db = DB::getConnection();
         $stm = $db->prepare("SELECT * FROM perfil WHERE id=?");
         $stm->bindParam(1, $id);
         $stm->execute();
         return $stm->fetch(PDO::FETCH_ASSOC);
      } catch (\Throwable $th) {
         return ["ErrorApi" => $th->getMessage()];
      }
   }

   public static function updatePerfil($id, $p)
   {

      try {
         $db = DB::getConnection();
         $stm = $db->prepare("UPDATE perfil SET perfil=?,descripcion=? WHERE id=?");
         $stm->bindParam(1, $p->perfil);
         $stm->bindParam(2, $p->descripcion);
         $stm->bindParam(3, $id);
         $stm->execute();
         return $stm->rowCount();
      } catch (\Throwable $th) {
         return ["ErrorApi" => $th->getMessage()];
      }
   }

   public static function deletePerfil($id)
   {
      try {
         $db = DB::getConnection();
         $stm = $db->prepare("UPDATE perfil SET estatus=0 WHERE id=?");
         $stm->bindParam(1, $id);
         $stm->execute();
         return $stm->rowCount();
      } catch (\Throwable $th) {
         return ["ErrorApi" => $th->getMessage()];
      }
   }

   public static function addModulos($id_perfil, $modulos)
   {
      $db = DB::getConnection();
      try {
         $db->beginTransaction();

         $stm = $db->prepare("DELETE FROM modulo_perfil WHERE id_perfil=?");
         $stm->bindParam(1, $id_perfil, PDO::PARAM_INT);
         $stm->execute();

         $stm = $db->prepare("INSERT INTO modulo_perfil(id_perfil,id_modulo) VALUES(:perfil,:modulo)");

         foreach ($modulos as $id_modulo) {
            $stm->bindParam(":perfil", $id_perfil, PDO::PARAM_INT);
            $stm->bindParam(":modulo", $id_modulo, PDO::PARAM_INT);
            $stm->execute();
         }

         $db->commit();
         return 1;
      } catch (\Throwable $th) {
         $db->rollBack();
         return ["ErrorApi" => $th->getMessage()];
      }
   }
}
