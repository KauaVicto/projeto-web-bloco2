<?php

class Banco {
    private static $servidor = 'localhost';
    private static $usuario = 'root';
    private static $senha = '';
    private static $database = 'projetoweb_kaua';

    public static function getServidor(){
        return self::$servidor;
    }
    public static function getUsuario(){
        return self::$usuario;
    }
    public static function getSenha(){
        return self::$senha;
    }
    public static function getDatabase(){
        return self::$database;
    }
}