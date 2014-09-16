<?php
require_once("class/class_posts.php");
require_once("class/class_users.php");
require_once("class/class_common.php");

$common = new Common();

if(!$common->isUserAuthenticated()){
	return;
}

$data = $_POST['data'];

$user = new User();
$userInfo = $user->getUser($_SESSION["steamid"]);

if ($userInfo) {
	$isAdmin = $user->isAdmin($userInfo);
	
	if(!$isAdmin){
		echo json_encode(["error"=>"not_authorised"]);
		return;
	}
} else{
	echo json_encode(["error"=>"invalid_user"]);
	return;
}

if(isset($data["path"]) and isset($data['type']) and isset($data['dispname']) and isset($data['header']) and isset($data['content']) == false){
	echo json_encode(["error"=>"incomplete_form"]);
	return;
}

$newPage = new PostManagement();
$type = $newPage->getTemplateUrl($data['type']);

if($type == false){
	echo json_encode(["error"=>"invalid_template"]);
	return;
}

$newPage->makeNewPage($data['dispname'], $data['path'], $type, $data['path']);
$newPage->populatePageWithContent($data['header'], $data['content'], $data['path'], $data['extra']);
