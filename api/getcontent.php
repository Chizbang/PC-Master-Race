<?php
require_once("class/Parsedown.php");
require_once('class/class_pages.php');

if(!isset($_GET['page'])){
	echo json_encode(["error"=>"invalid_page"]);
	return;
}

$Parsedown = new Parsedown();
$page = new Pages();

$result = $page->getContent($_GET['page']);

if($result){
	$result[0]['content'] = $Parsedown->text($result[0]['content']);
	echo json_encode($result);
} else{

}