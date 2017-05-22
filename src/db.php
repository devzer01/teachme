<?php
/**
 * Created by PhpStorm.
 * User: nayana
 * Date: 20/5/2560
 * Time: 5:58 น.
 */

class Db {

    protected $pdo = null;

    protected $table = "";

    protected $fields = [];

    protected $values = [];

    protected $primary = 'id';

    public function __construct()
    {
        $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'', PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        $this->pdo = new PDO("mysql:host=localhost;dbname=tridiction;charset=UTF8", "tridiction", "x2c4eva", $options);
    }

    public function init() {
        $sql = "SHOW FIELDS FROM " . $this->table;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $fields = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($fields as $field) {
            if ($field['Field'] == 'id') continue;
            $this->fields[] = $field['Field'];
        }
    }

    function __set($name, $value)
    {
        if (in_array($name, $this->fields)) {
            return ($this->values[$name] = $value);
        }

        throw new Exception('field not found');
    }

    function setAll($values)
    {
        foreach ($values as $k => $v) {
            $this->values[':' . $k] = $v;
        }
    }

    public function fields() {
        return $this->fields;
    }

    protected function select() {
        $sql = "SELECT * FROM " . $this->table;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function all()
    {
        return $this->select();
    }

    public function entry()
    {
        if (empty($this->values) && count($this->values) !== count($this->fields)) throw new Exception("values are empty");
        try {
            $sql = "INSERT INTO " . $this->table . "(" . implode(",", $this->fields) . ")" .
                " VALUES (:" . implode(",:", $this->fields) . ")";
            print_r(count($this->values), count($this->fields));
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($this->values);
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            print_r($e);
        }
    }

    public function get($value)
    {
        return $this->_get($value)[0];
    }

    protected function _get($value)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE " . $this->primary . " = '" . $value . "'";
        echo $query;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function exist($value) {
        if ($this->_get($value)) {
            $rows = $this->_get($value)[0];
            $this->id = $rows[0]['id'];
            return (count($rows) !== 0);
        }
        return false;
    }
}