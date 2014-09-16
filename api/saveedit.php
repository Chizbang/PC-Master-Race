<?php
require_once('class/class_posts.php');
require_once('class/class_users.php');

if(!session_id()){
	session_start();
}

if(!isset($_SESSION['steamid'])){
	echo json_encode(["error"=>"not_logged_in"]);
	return;	
}
$pageManagement = new PostManagement();
$user = new User();

$userInfo = $user->getUser($_SESSION['steamid']);

if(empty($userInfo)){
	echo json_encode(["error"=>"invalid_user"]);
	return;
} else if($userInfo){
	$isAdmin = $user->isAdmin($userInfo);
	if(!$isAdmin){
		echo json_encode(["error"=>"not_authorised"]);
		return;
	}
}

$data = $_POST['data'];


if($data['where'] == "header" and isset($data['content']) and isset($data['page'])){
	$pageManagement->editPostHead($data['content'], $data['page']);
} elseif($data['where'] == "content" and isset($data['content'])  and isset($data['page'])){
	$pageManagement->editPostContent($data['content'], $data['page']);
} else{
	echo json_encode(["error"=>"empty"]);
}