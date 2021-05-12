<?php
namespace App\Util;
use Firebase\JWT\JWT;


class AuthJWT
{
    private static $secret_key = '';
    private static $encrypt = ['HS256'];
    private static $aud = null;

    private static function getKey()
    {
        self::$secret_key="ClaveSecreta";
    }

    public static function SignIn($data)
    {
        self::getKey();
        $time = time();
        $token = array(
            'iat' => $time, // Tiempo que inició el token
            'exp' => $time + (60*60),// Tiempo que expirará el token (+1 hora)
            'aud' => self::Aud(),
            'data' => $data
        );

        return JWT::encode($token, self::$secret_key);
    }

    public static function Check($token)
    {
        self::getKey();
        if(empty($token))
        {
            throw new \Exception("Invalid token supplied.");
        }

        $decode = JWT::decode(
            $token,
            self::$secret_key,
            self::$encrypt
        );

        if($decode->aud !== self::Aud())
        {
            throw new \Exception("Invalid user logged in.");
        }
    }

    public static function GetData($token)
    {
        self::getKey();
        return JWT::decode(
            $token,
            self::$secret_key,
            self::$encrypt
        )->data;
    }

    private static function Aud()
    {
        $aud = '';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $aud = $_SERVER['REMOTE_ADDR'];
        }

        $aud .= @$_SERVER['HTTP_USER_AGENT'];
        $aud .= gethostname();

        return sha1($aud);
    }
}