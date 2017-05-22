<?php
/**
 * Created by PhpStorm.
 * User: nayana
 * Date: 20/5/2560
 * Time: 6:07 น.
 */

require_once 'db.php';

class Word extends Db {

    protected $payload = null;

    protected $words = null;

    protected $primary = 'word';

    protected $table = 'word';

    protected $fields = [];

    public function __construct()
    {
        parent::__construct();
        parent::init();
    }

    public function conceptByRef($word)
    {
        $sql = " SELECT c.id, c.name " .
               " FROM word_concept AS wc " .
               " JOIN concept AS c ON c.id = wc.concept_id " .
               " JOIN word AS w ON w.id = wc.word_id " .
               " WHERE w.word LIKE :word ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':word' => $word]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function reference($name)
    {
        if (!$this->exist($name)) return false;

        $word = $this->get($name);
        return $this->conceptByRef($word['id']);
    }

    protected function _get($value)
    {
        $query = "SELECT * FROM word WHERE word LIKE :word";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':word' => $value . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get($value)
    {
        return $this->_get($value)[0];
    }

    public function exist($value) {
        return (count(static::_get($value)) !== 0);
    }
}