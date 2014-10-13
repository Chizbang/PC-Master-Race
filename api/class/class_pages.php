<?php

require_once("class_database.php");

class Pages{
	function getPages(){
		$fetchAllDB = new Database();
		$result = $fetchAllDB->preparedQuery("SELECT * FROM pages", array())->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}

	function getContent($page){
		$fetchContentDB = new Database();
		$result = $fetchContentDB->preparedQuery("SELECT * FROM content WHERE name = ?", array($page))->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
}