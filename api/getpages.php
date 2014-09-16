<?php
include('class/class_database.php');
$fetchAllDB = new Database();
$result = $fetchAllDB->preparedQuery("SELECT * FROM pages", array())->fetchAll(PDO::FETCH_ASSOC);
if($result){
	echo json_encode($result);
} else {

}


