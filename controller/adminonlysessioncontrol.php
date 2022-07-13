<?php
	if(!isset($_SESSION['file_adminId'])){
		header('location:index.php');
	}
	if(isset($_SESSION['file_state'])){
		$state = $_SESSION['file_state'];
	}else{
		$state="Login";
	}
	if(isset($_POST['Logout'])){
		$log = new login;
		$log->logout();
	}
	if(isset($_POST['Login'])){
		$log = new Login;
		$log->tologin();	
	}
?>