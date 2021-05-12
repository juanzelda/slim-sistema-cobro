<?php

namespace App\DAO;

use App\Util\DataBase as DB;
use \PDO;
use Carbon\Carbon;


class UsuarioDAO
{

    public function __construct()
    {
    }


    public static function createUser($p)
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare("INSERT INTO usuarios(username,password) VALUES(?,?)");
            $stm->bindParam(1, $p->username);
            $stm->bindParam(2, $p->password);
            $stm->execute();
            return $db->lastInsertId();
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function getUsuarios()
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare("SELECT usuarios.id,username,GROUP_CONCAT(perfil.perfil) AS perfiles 
            FROM usuarios 
            INNER JOIN usuario_perfil ON usuarios.id=usuario_perfil.id_usuario
            INNER JOIN perfil ON usuario_perfil.id_perfil=perfil.id GROUP BY usuarios.id");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }
    public static function getUsuario($id)
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

    public static function updateUsuario($id, $p)
    {
        try {
            $db = DB::getConnection();
            $stm = $db->prepare("UPDATE usuarios SET username=?,password=? WHERE id=?");
            $stm->bindParam(1, $p->username);
            $stm->bindParam(2, $p->password);
            $stm->bindParam(3, $id);
            $stm->execute();
            return $stm->rowCount();
        } catch (\Throwable $th) {
            return ["ErrorApi" => $th->getMessage()];
        }
    }

    public static function deleteUsuario($id)
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

    public static function addPerfil($id)
    {
    }
}
