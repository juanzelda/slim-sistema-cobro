<?php
namespace App\DAO;

use App\Entity\Perfil;

class ColaboradorDAO
{

    public function __construct()
    {}

    public static function createPerfil($p)
    {
         try {
            $db= DB::getConnection();
            $stm=$db->prepare("INSERT INTO perfiles('perfil','descripcion') VALUES(?,?)");
            $stm->bindParam(1,$p->perfil);
            $stm->bindParam(2,$p->descripcion);
            $stm->execute();

        } catch (\Throwable $th) {
            return ["ErrorApi"=>$th->getMessage()];
        }
    }

    public static function getPerfiles()
    {
         try {
            $db= DB::getConnection();
            $stm=$db->prepare("SELECT * FROM perfiles");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return ["ErrorApi"=>$th->getMessage()];
        }
    }

}
