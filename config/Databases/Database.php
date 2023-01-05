<?php

namespace Config\Databases;

abstract class Database
{
    private static $dsn = 'mysql:dbname=test-db;host=localhost'; // dbname=nom de la base de donnée; host=localhost
    private static $db_user = 'root'; // db_user=nom d'utilisateur de la base de donnée
    private static $db_password = ''; // db_user=mot de passe de l'utilisateur de la base de donnée
    private static $db_attributes = [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET UTF8'
    ];
    private static $pdo;

    /**
     * La fonction retourne une instance de PDO avec la connexion à la base de donnée
     *
     * @return \PDO
     */
    protected function getPDO(): \PDO
    {
        try {
            if (is_null(self::$pdo)) {
                self::$pdo = new \PDO(self::$dsn, self::$db_user, self::$db_password, self::$db_attributes);
            }
            return self::$pdo;
        } catch (\PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
}