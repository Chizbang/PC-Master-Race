<?php
include('class/class_database.php');
if(!isset($_SESSION)){
	session_start();
	
	if(!isset($_SESSION['steamid'])){
		echo json_encode(["error"=>"204"]);
		return;
	}

	//Make sure to take advantage of the user class.
	
	
	$checkQuery = new Database();
	$query = $checkQuery->preparedQuery("SELECT * FROM users WHERE steamid=?", array($_SESSION['steamid']))->fetchAll(PDO::FETCH_ASSOC);
	
	if(empty($query)){
		echo json_encode(["error"=>"not_admin"]);
		return;
	} else{
		$userInfo = ["steamid"=>$_SESSION['steamid'], "username"=>$_SESSION['username'], "realname"=>$_SESSION['realname']];
		echo json_encode($userInfo);
	}

}