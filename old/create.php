<?php
/**
 * Created by PhpStorm.
 * User: nayana
 * Date: 19/5/2560
 * 6043147914
 * Time: 22:10 น.
 */

require_once 'lib/db.php';
require_once 'lib/Concept.php';

$db = new Db();
$concept = new Concept($_POST);

$words = $concept->extract();

//save concept
//add words
//associate words <> concept

foreach ($words as $word) {

    if ($db->isWord($word)) {
        continue;
    }

    $query = "SELECT id, word FROM word WHERE word = :word ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':word' => $word]);
    $id = 0;
    if ($stmt->rowCount() === 0) {
        $query = "INSERT INTO word (word) VALUES (word)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':word' => $word]);
        $id = $pdo->lastInsertId();
    } else {
        $rword = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        $id = $rword[0];
    }

    $query = "INSERT INTO word_concept (concept_id, word_id) "
            . "VALUES (:concept_id, :word_id)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':concept_id' => $concept_id, ':word_id' => $id]);

}

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
echo json_encode($results);