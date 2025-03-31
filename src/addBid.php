<?php
session_start();
if (!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] == false) {
	http_response_code(401);
	return;
}

$amount = $_POST['amount'];
$auction = $_POST['auction'];
$bidder = $_POST['bidder'];

require_once './Database.php';

$db = Database::getInstance();

$sql = "INSERT INTO bids (amount, auction, bidder) VALUES ('$amount', '$auction', '$bidder')";

if ($db->query($sql) === true) {
	$response = [
		'name' => '',
		'amount' => $amount
	];

	$sql = "SELECT name FROM personal_details WHERE email = '$bidder'";
	$res = $db->query($sql);
	$response['name'] = $res->fetch_object()->name;
	http_response_code(200);
	echo json_encode($response);
} else {
	http_response_code(500);
}

