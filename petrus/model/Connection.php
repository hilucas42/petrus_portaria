<?php
namespace model;

class Connection {

    const HOST   = 'localhost';
    const DBNAME = 'petrus';
    const USER   = 'username';
    const PASS   = 'password';
    private static $conn;

    public static function getConnection() {
        if (is_null(self::$conn)) {
            try {
                self::$conn = new \PDO('pgsql:' .
                    'host=' . self::HOST . ';' .
                    'dbname=' . self::DBNAME,
                    self::USER,
                    self::PASS
                );
                self::$conn->setAttribute(
                    \PDO::ATTR_ERRMODE,
                    \PDO::ERRMODE_EXCEPTION
                );
            } catch (\PDOException $e) {
                error_log($e->getMessage());
                return null;
            }
        }
        return self::$conn;
    }
}
