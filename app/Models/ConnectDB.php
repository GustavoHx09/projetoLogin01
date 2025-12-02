<?php

namespace App\Models;

use PDO;
use PDOException;

class ConnectDB {

    private static $conn;

    private static function Conectar() {
        try {
            // verifica se a conexão não existe
            if (self::$conn == null):
                $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_DATABASE'];
                self::$conn = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS'], null);
            endif;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return  self::$conn;
    }

    public static function retornarConexao() {
        return  self::Conectar();
    }
}
