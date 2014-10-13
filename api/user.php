<?php
include('class/class_users.php');
if(!isset($_SESSION)){
	session_start();
	
	if(!isset($_SESSION['steamid'])){
		echo json_encode(["error"=>"invalid_user"]);
		return;
	}
	
	$user = new User();
	$adminCheck = $user->isAdmin($_SESSION['steamid']);
	
	if(empty($adminCheck)){
		echo json_encode(["error"=>"not_admin"]);
		return;
	} else{
		$userInfo = ["steamid"=>$_SESSION['steamid'], "username"=>$_SESSION['username'], "realname"=>$_SESSION['realname']];
		echo json_encode($userInfo);
	}

}