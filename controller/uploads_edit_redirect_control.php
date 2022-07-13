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
		if($_SESSION["type"] =="view"){
			if(isset($_SESSION["file_address"])){
				$download = new uploads;
				$ret = $download->updateActivity($fida,"Viewed");
				if($ret == "true"){
					header("location:".$_SESSION["file_address"]);
				}else{
					$_SESSION["message"] = "Please Try Again";
				}
			}
		}else{
			$file_address = filter_input(INPUT_POST, "file_address");
			$file_id = filter_input(INPUT_POST, "file_id");
			unset($_SESSION["message"]);
			if(isset($file_address)){
				echo"<script>swal('Your download will start soon.');</script>";
				$download = new uploads;
				$ret = $download->updateActivity($file_id,"Downloaded");
				if($ret == "true"){
					$ret = $download->downloader($file_address);
				}else{
					$_SESSION["message"] = "Please Try Again";
				}
			}			
		}
	}else{
		$_SESSION["message"] = "Error!";
	}
}
/*===================================================
To Download the uploaded file
=========================================================*/
if(isset($_POST["view_upload"])){
	$address = filter_input(INPUT_POST, "file_address");
	$id = filter_input(INPUT_POST, "file_id"); 
	$prone = filter_input(INPUT_POST, "file_prone");
	unset($_SESSION["message"]);
	$_SESSION["type"] = "view";
	
	$_SESSION["file_id"] = $id;
	$_SESSION["file_address"] = $address;
	$_SESSION["file_prone"] = $prone;
	if($prone == "YES"){
		header("location:uapprove.php");
	}else{
		header("location:".$_SESSION["file_address"]);
	}
}
/*===================================================
To Download the uploaded file
=========================================================*/
if(isset($_POST["download_upload"])){

	$address = filter_input(INPUT_POST, "file_address");
	$id = filter_input(INPUT_POST, "file_id"); 
	$prone = filter_input(INPUT_POST, "file_prone");
	unset($_SESSION["message"]);
	
	$_SESSION["type"] = "download";

	$_SESSION["file_id"] = $id;
	$_SESSION["file_address"] = $address;
	$_SESSION["file_prone"] = $prone;
	if($prone == "YES"){
		header("location:uapprove.php");
	}else{
		$download = new uploads;
		$ret = $download->downloader($address);
	}
}
/*=============================================================
Takes you to the single document view
===============================================================*/
if(isset($_POST["viewactivity"])){
	$id = filter_input(INPUT_POST, "file_id");
	$_SESSION["file_id"] = $id;
	header("location:uacts.php");
}

?>