<?php
/**
 * Created by PhpStorm.
 * User: fenix
 * Date: 18.12.2020
 * Time: 16:43
 */

class Db
{
    protected $pdo;
    protected static $instance;

    protected function __construct()
    {
        $db = include ROOT . "/config/config_db.php";

        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ];
        $this->pdo = new \PDO($db['dns'], $db['user'], $db['pass'], $options);
    }

    public static function instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function execute($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);

    }

    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute($params);

        if ($res !== false) {
            return $stmt->fetchAll();
        }
        return [];
    }

}