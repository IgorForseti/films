<?php
/**
 * Created by PhpStorm.
 * User: fenix
 * Date: 18.12.2020
 * Time: 23:00
 */

namespace app\Models;

use Db;
abstract class Model
{
    protected $pdo;
    protected $table;
    protected $orderField;

    public function __construct() {
        $this->pdo = Db::instance();
    }

    public function query($sql, $params = []) {
        return $this->pdo->execute($sql, $params);
    }

    /**
     * @param int $id
     * @return array
     */
    public function findOne($id) {
            $sql = "SELECT * FROM  $this->table WHERE id = ? LIMIT 1";
            return $this->pdo->query($sql, [$id]);
    }

    public function findAll() {
        $sql = "SELECT * FROM $this->table ORDER BY $this->table.$this->orderField ASC";
        return $this->pdo->query($sql);
    }

    /**
     * @param $fields - fiels in DB
     * @param array $values
     * @return bool
     */
    public function create($fields,$values) {
        $sql = "INSERT INTO $this->table ($fields) VALUES (?, ? , ? , ?)";
        return self::query($sql, [$values[0], $values[1], $values[2], $values[3]]);
    }

    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        return self::query($sql, [$id]);
    }

    public function check($field, $value) {
        $sql = "SELECT * FROM $this->table WHERE $field[0] = ? AND $field[1] = ? AND $field[2] = ? ";
        return $this->pdo->query($sql, [$value[0], $value[1], $value[2]]);
    }

    /**
     * @param $field - field for search
     * @param $q - value for LIKE
     * @return array
     */
    public function findLike($field, $q) {
        $sql = "SELECT * FROM $this->table WHERE $field LIKE ?";
        return $this->pdo->query($sql, [ '%'.$q.'%']);
    }

    public static function replaceSpecialChar($data) {
        foreach ($data as &$d) {
            $d = htmlspecialchars($d, ENT_QUOTES);
        }
        return $data;
    }

    public function pagination($data, $count_line, $current_page) {
        $result = [];
        foreach ($data as $key => $val) {
            if ($key >= $count_line * ($current_page - 1) && $key < $count_line * $current_page) {
                $result[$key] = $val;
            }
        }
        return $result;
    }
}