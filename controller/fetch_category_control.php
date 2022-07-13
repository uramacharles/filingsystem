<?php
	if(isset($_SESSION["file_adminId"])){
		$getter = new category;
			//$this->items = array("id","name","planename");
		$category = $getter->listCategory();
		$catcount = count($category);
	}else{
		$category = "";
	}
?>