<?php
if(isset($_POST["delete_conf"])){
	
	$inputpass = filter_input(INPUT_POST, "confid");
	$id = $_SESSION["fid"];
	$_SESSION["done"] = "YES";
	$check = new uploads;
	$ret = $check->check_confidential_password(md5($inputpass),$id);
	if($ret != "false"){
		$ret = $check->deleteupload($id);
		if($ret == "true"){
			echo"<script>swal('Success!','Successfully Deleted','success');</script>";
		}else{
			echo"<script>swal('Opps!','Error encountered while processing your request. Please try again.','error');</script>";
		}
	}else{
		echo"<script>swal('Opps!','the password Supplied is invalid. Please try again.','error');</script>";
	}
}

if (isset($_POST["delete_noconf"])){
	$id = $_SESSION["fid"];
	$confirm = filter_input(INPUT_POST, "confirm");
	if($confirm == "YES"){
		$delete = new uploads;
		$ret = $delete->deleteupload($id);
		if($ret == "true"){
			unset($_SESSION["fid"]);
			unset($_SESSION["conf"]);
			echo"<script>swal('Successful','Post Deleted.','success');</script>";
		}else{
			echo"<script>swal('Opps!','Error encountered while processing your request. Please try again.','error');</script>";
		}
	}else{
		echo"<script>swal('success','Operation canceled','success');</script>";
	}
}

?>