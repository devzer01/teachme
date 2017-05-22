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

$results = $db->templates();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
echo json_encode($results);