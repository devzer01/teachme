<?php
/**
 * Created by PhpStorm.
 * User: nayana
 * Date: 19/5/2560
 * Time: 22:10 น.
 */

$options = [];
$pdo = new PDO("mysql:host=localhost;dbname=tridiction", "tridiction", "x2c4eva", $options);

$topic = $_GET['topic'];
$words = explode($topic, " ");

$keywords = "";
if (count($words) >= 1) {
    $keywords = $topic;
} else {
    $keywords = implode("','", $words);
}

$query = "
  SELECT w.id AS word_id, c.name AS concept, c.description AS description, ct.name AS type
  FROM word AS w 
  JOIN word_concept AS wc ON wc.word_id = w.id 
  JOIN concept AS c ON c.id = wc.concept_id
   JOIN concept_type AS ct ON ct.id = c.id 
  WHERE w.word IN ('" . $keywords . "')
";
//echo $query;
$stmt = $pdo->prepare($query);
$stmt->execute();


$results = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
echo json_encode($results);