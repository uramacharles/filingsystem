<?php
/*========================================
Fetch data from the SESSION
===================================================*/
if(isset($_SESSION["conf"])){
	$conf = $_SESSION["conf"];
	$fid = $_SESSION["fid"];
}
/*========================================
Fetch data from the SESSION For 
===================================================*/
if(isset($_SESSION["file_prone"])){
	$confa = $_SESSION["file_prone"];
	$fida = $_SESSION["file_id"];
}
if(isset($_POST["approve"])){	
	$inputpass = filter_input(INPUT_POST, "confid");
	unset($_SESSION["message"]);
	$id = $_SESSION["file_id"];
	$check = new documents;
	echo $ret = $check->check_confidential_password(md5($inputpass),$id);
	if($ret != "false"){
		header("location:document.php");
	}else{
		$_SESSION["message"] = "Error!";
	}
}

/*=============================================================
Takes you to the single document view
===============================================================*/
if(isset($_POST["edit_document"])){
	$address = filter_input(INPUT_POST, "file_address");
	$id = filter_input(INPUT_POST, "file_id"); 
	$prone = filter_input(INPUT_POST, "file_prone");
	$_SESSION["file_id"] = $id;
	$_SESSION["file_address"] = $address;
	$_SESSION["file_prone"] = $prone;
	if($prone == "YES"){
		header("location:approve.php");
	}else{
		header("location:document.php");
	}
}
/*=============================================================
Takes you to the single document view
===============================================================*/
if(isset($_POST["viewactivity"])){
	$id = filter_input(INPUT_POST, "file_id");
	$_SESSION["file_id"] = $id;
	header("location:acts.php");
}

if(isset($_GET["title"])||isset($_SESSION["post_address"])){
	$get_old = new posts;
	if(isset($_GET["title"])){
		$id = intval($_GET["by"]);
		$tit = htmlentities($_GET['title']);
		$single = $get_old->getPostByTitle($tit,$id);
	}elseif(isset($_SESSION["post_address"])){
		$id = intval($_SESSION["post_id"]);
		$tit = htmlentities($_SESSION['post_address']);
		$single = $get_old->getPostByTitle($tit,$id);
	}
		//$this->items = array("id","title","titlelink","post","category","post_land_image","post_other_image","date_updated");
	if($single != "false"){
		$post_id = $single[0];
		$post_title = $single[1];
		$post_titlelink = $single[2];
		$post_story = $single[3];
		$post_category = $get_old->getCategory($single[4]);
		$post_land_image = $get_old->formatUrlforAdmin($single[5]);
		$post_other_image = explode("#", $single[6]);
		$imgcount = count($post_other_image);
		$post_date_updated = $single[7];
	}
}
	$get_cat = new category;
	$category = $get_cat->listCategory();
	$catcount = count($category);
?>