<?php
require_once("class_database.php");

class User{
	public function __construct(){
	}

	public function getUser($user){
		$getUserQuery = new Database();
		$getUserQueryResult = $getUserQuery->preparedQuery("SELECT * FROM users WHERE steamid = ?", array($user))->fetchAll(PDO::FETCH_ASSOC);

		if(empty($getUserQueryResult)){
			return false;
		}

		foreach ($getUserQueryResult as $field) {
			return $field['steamid'];	
		}
	}

	public function isAdmin($user){
		$isUserAdminQuery = new Database();
		$isUserAdminQueryResult = $isUserAdminQuery->preparedQuery("SELECT * FROM users WHERE steamid = ?", array($user))->fetchAll(PDO::FETCH_ASSOC); // need to add an admin field to the schema
		if(empty($isUserAdminQueryResult)){
			return false;
		} else{
			return true;
		}
	} 
} 