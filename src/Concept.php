<?php
/**
 * Created by PhpStorm.
 * User: nayana
 * Date: 20/5/2560
 * Time: 6:07 น.
 */

require_once 'db.php';

class Concept extends Db {

    protected $words = null;

    protected $table = 'concept';

    protected $fields = [];

    protected $template = null;

    protected $sense = null;

    public function __construct()
    {
        parent::__construct();
        parent::init();
    }

    public function assoc($concept_id, $ids) {
        foreach ($ids as $word_id) {
            $sql = "INSERT INTO word_concept (concept_id, word_id) VALUES (:concept_id, :word_id)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':concept_id' => $concept_id, ':word_id' => $word_id]);
        }

        return true;
    }

    public function get($id)
    {
        $query = "SELECT * FROM concept WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function exist($id)
    {
        $query = "SELECT * FROM concept WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        return count($stmt->fetchAll(PDO::FETCH_ASSOC)) !== 0;
    }

    public function entry()
    {
        $this->values[':sense_id'] = 0;
        return parent::entry();
    }
}