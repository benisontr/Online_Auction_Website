<?php
$id = $_POST['id'];

require_once './Database.php';

$db = Database::getInstance();

$sql = "SELECT MAX(amount) as amount, auction, bidder FROM bids WHERE auction = '$id' GROUP BY bidder";

$res = $db->query($sql);
$owner = $res->fetch_object();

$sql = "SELECT id FROM bids WHERE auction = '$owner->auction' and bidder = '$owner->bidder' and amount = '$owner->amount'";
$res = $db->query($sql);
$id = $res->fetch_object()->id;

$sql = "INSERT INTO winner (auction, bid, winner) VALUES ('$owner->auction', '$id', '$owner->bidder')";
$db->query($sql);

echo json_encode($owner);

