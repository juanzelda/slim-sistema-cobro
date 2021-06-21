<?php
namespace App\Util;
use \PDO;

class DataBase
{

    public static function getConnection()
    {
        try
        {
            $pdo = new PDO('mysql:host=127.0.0.1;port=3307;dbname=sistema_cobro;charset=utf8', 'peloy', 'peloy_1000');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            return $pdo;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
