<?php
require_once("class/class_database.php");
require_once("class/class_users.php");

if(!session_id()){
	session_start();
}
if(!isset($_SESSION['steamid'])){
	echo json_encode(["error"=>"not_logged_in"]);
	return;
}

$fetchAllTemplatesQuery = new Database();
$result = $fetchAllTemplatesQuery->preparedQuery("SELECT * FROM templates", array())->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);
