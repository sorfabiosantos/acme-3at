<?php

namespace source\Core;

use PDO;
use PDOException;

abstract class Connect
{
    private const OPTIONS = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ];

    private static $instance;

    public static function getInstance(): ?PDO
    {
        if (empty(self::$instance)) {
            try {
                self::$instance = new PDO(
                    "mysql:host=" . CONF_DB_HOST . ";port=". CONF_DB_PORT .";dbname=" . CONF_DB_NAME,
                    CONF_DB_USER,
                    CONF_DB_PASS,
                    self::OPTIONS
                );
            } catch (PDOException $exception) {
                $resposse = [
                    "type" => "error",
                    "message" => "Problemas ao conectar com o banco de dados!. " . $exception->getMessage() . "-" . $exception->getCode()
                ];
                echo json_encode($resposse);
                exit();
            }
        }

        return self::$instance;
    }

    final private function __construct()
    {
    }

    private function __clone()
    {
    }
}