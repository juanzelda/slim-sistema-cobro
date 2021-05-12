<?php
namespace App\DAO;
use App\Util\DataBase AS DB;
use Envms\FluentPDO\Query AS FluentPdo;
use \PDO;

// use App\Entity\Usuario;

class SecurityDAO
{

    public function __construct()
    {}

    public static function initSesion($p)
    {
        try {
            $db= DB::getConnection();
            $stm=$db->prepare("SELECT usuarios.id,username,password FROM usuarios 
            INNER JOIN usuario_perfil ON usuarios.id=usuario_perfil.id_usuario 
            INNER JOIN perfil ON usuario_perfil.id_perfil=perfil.id 
            WHERE username=? AND password=?");
            $stm->bindParam(1,$p->usuario);
            $stm->bindParam(2,$p->password);
            $stm->execute();

            return $stm->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return ["ErrorApi"=>$th->getMessage()];
        }
    }

}
