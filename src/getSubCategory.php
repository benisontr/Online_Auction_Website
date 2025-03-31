<?php
$id = $_POST['id'];

require_once './Database.php';

$db = Database::getInstance();

$categories = [];
$sql = "SELECT * FROM sub_category WHERE category = '$id'";

$res = $db->query($sql);
while($row = $res->fetch_object()){
    $categories[] = $row;
}

echo json_encode($categories);

