<?php
$del = new register;
$rec = new recovery;
$rec->deleteRecovery();
$act = new activation;
$act->deleteActivation();
if (isset($_POST['addlawyer'])){
	$name = filter_input(INPUT_POST,"name");
	$username = filter_input(INPUT_POST,"username");
	$password = filter_input(INPUT_POST,"password");
	$ret_password = filter_input(INPUT_POST,"ret_password");
	$email = filter_input(INPUT_POST, "email");
	
	$upload = new register;
	/*===================================
	Update the database
	========================================*/
	$upload->setText("name",$name);
	$upload->setText("username",$username);
	$upload->setText("email",$email);
	$upload->setPassword($password,$ret_password);
	$res = $upload->adadmin();
	if($res == "true"){
		echo "<script>swal('Successful','You are successfully registered. Please kindly check your email for the activation code.','success');</script>";
		$_SESSION["message"] = "You are successfully registered. Please kindly check your email for the activation code.";
		$_SESSION["gotoactivation"]="true";
		$act = new activation;
		$act->setText("email",$email);
		$act->sendactivationCode();
	}elseif($res == "false"){
		echo "<script>swal('Not Successful','Please try again','error');</script>";
	}else{
		echo $res;
	}
}
if(isset($_POST['changefirst'])){
	$add = new register;
	$old_password = md5(filter_input(INPUT_POST, "old_password"));
	$new_password = md5(filter_input(INPUT_POST, "new_password"));
	$username = filter_input(INPUT_POST, "username");
	/*===================================
	Chech if the username matches with the password
	========================================*/
	$add->setText("old_password1",$old_password);
	$add->setText("password1",$new_password);
	$add->setText("username1",$username);
	$res = $add->editAdminAccess1();
	if($res == "true"){
		echo "<script>swal('Successful.',  'First user password have been changed', 'success');</script>";
	}elseif($res == "false"){
		echo "<script>swal('Not Successful','Please try again','error');</script>";
	}else{
		echo $res;
	}
}
if(isset($_POST['changesecond'])){
	$add = new register;
	$old_password = md5(filter_input(INPUT_POST, "old_password"));
	$new_password = md5(filter_input(INPUT_POST, "new_password"));
	$username = filter_input(INPUT_POST, "username");
	/*===================================
	Chech if the username matches with the password
	========================================*/
	$add->setText("old_password2",$old_password);
	$add->setText("password2",$new_password);
	$add->setText("username2",$username);
	$res = $add->editAdminAccess2();
	if($res == "true"){
		echo "<script>swal('Successful.',  'Second user password have been changed', 'success');</script>";
	}elseif($res == "false"){
		echo "<script>swal('Not Successful','Please try again','error');</script>";
	}else{
		echo $res;
	}
}
if(isset($_POST['details'])){
	$add = new register;
	$name = filter_input(INPUT_POST, "name");
	$chamber_name = filter_input(INPUT_POST, "chamber_name");
	$description = filter_input(INPUT_POST, "description");
	/*===================================
	Update the update information
	========================================*/
	$add->setText("name",$name);
	$add->setText("chamber_name",$chamber_name);
	$add->setText("description",$description);
	$res = $add->editAdminInfo();
	if($res == "true"){
		echo "<script>swal('Successful.',  'Admin infornation have been saved', 'success');</script>";
	}elseif($res == "false"){
		echo "<script>swal('Not Successful','Please try again','error');</script>";
	}else{
		echo $res;
	}
}
if(isset($_POST['changeemail'])){
	$add = new register;
	$email = filter_input(INPUT_POST, "email");
	/*===================================
	Update the update information
	========================================*/
	$add->setText("email",$email);
	$res = $add->editAdminEmail();
	if($res == "true"){
		echo "<script>swal('Successful.',  'Recovery email have been updated', 'success');</script>";
	}elseif($res == "false"){
		echo "<script>swal('Not Successful','Please try again','error');</script>";
	}else{
		echo $res;
	}
}
if(isset($_POST['savenewpix'])){
	$change = new register;
	/*===================================
	upload the picture
	========================================*/
	$patharray = array('profile');
	$path = $change->createDirectory($patharray);
	//For Picturs
	$r = $_FILES['admin_image']['name'];
	if(strlen($r)-stripos($r,'.') == 4){
		$myName = $_FILES['admin_image']['name'];
		$myTemp = $_FILES['admin_image']['tmp_name'];
		$imagepath = $change->uploadfile($myName,$myTemp,$path,"0");
		/*===================================
		Update the database with the new image path
		========================================*/
		$res = $change->editPix($imagepath);
		if($res != "false"){
			echo"<script>swal('Successful','Your changes have been made','success');</script>";
		}else{
			echo"<script>swal('Opps!','Error encountered while processing your request. Please try again.','error');</script>";
		}
	}else{
		echo"<script>swal('Image not recognized');</script>";
	}
}

?>