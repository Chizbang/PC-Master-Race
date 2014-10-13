<?php
include('class/class_pages.php');

$fetchAllPages = new Pages();
$result = $fetchAllPages->getPages();

if($result){
	echo json_encode($result);
} else {
}


