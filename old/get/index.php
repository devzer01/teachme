<?php
/**
 * Created by PhpStorm.
 * User: nayana
 * Date: 19/5/2560
 * 6043147914
 * Time: 22:10 น.
 */

require_once __DIR__ . '/../lib/db.php';
require_once __DIR__ . '/../lib/Concept.php';

$db = new Db();

switch ($_GET['q']) {
    case 'sense':
        $result = $db->sense();
        break;
    case 'template':
        $result = $db->template();
        break;
    case 'concept':
        $result = $db->concept();
        break;
}



header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
echo json_encode($result);