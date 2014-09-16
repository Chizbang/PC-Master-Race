<?php
include('class_database.php');
class Posts{
	public function __construct(){
	}
	public function populateWithAllPosts(){
		$populateWithAllPostsQuery = new Database();
		$populateWithAllPostsResult = $populateWithAllPostsQuery->query("SELECT * FROM posts")->fetchAll(PDO::FETCH_ASSOC);
	}
}
class PostManagement{
	public function __construct(){
	}

	public function makeNewPage($name, $state, $template, $path){
		$makePageQuery = new Database();
		$makePageQueryResult = $makePageQuery->preparedQuery("INSERT INTO `pages` (`id`, `name`, `stateName`, `templateUrl`, `path`) VALUES (null, ?, ?, ?, ?);", array($name, $state, $template, $path));

		if($makePageQueryResult){
			return true;
		} else {
			return false;
		}
	}

	public function populatePageWithContent($head, $content, $name, $extra){
		$populatePageQuery = new Database();
		$populatePageQueryResult = $populatePageQuery->preparedQuery("INSERT INTO `content` (`id`, `header`, `content`, `name`, `extra`) VALUES (null, ?, ?, ?, ?);", array($head, $content, $name, $extra));

		if($populatePageQueryResult){
			return true;
		} else {
			return false;
		}
	}

	public function getTemplateUrl($name){
		$templateQuery = new Database();
		$templateQueryResult = $templateQuery->preparedQuery("SELECT * FROM  `templates` WHERE name = ?", array($name))->fetchAll(PDO::FETCH_ASSOC);
		if(empty($templateQueryResult)){
			return false;
		} else{
			foreach ($templateQueryResult as $key) {
				return $key['templatedir'];
			}
		}
	}

	public function deletePage($name){
	}

	public function editPostHead($title, $name){
		$editPostQuery = new Database();
		$editPostQueryResult = $editPostQuery->preparedQuery("UPDATE `content` SET header=? WHERE name=?;", array($title, $name));

		if($editPostQueryResult){
			return true;
		} else {
			return false;
		}
	}

	public function editPostContent($content, $name){
		$editPostQuery = new Database();
		$editPostQueryResult = $editPostQuery->preparedQuery("UPDATE `content` SET content=? WHERE name=?;", array($content, $name));

		if($editPostQueryResult){
			return true;
		} else {
			return false;
		}
	}
}