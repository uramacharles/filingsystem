<?php
if(isset($_POST["delete_conf"])){
	
	$inputpass = filter_input(INPUT_POST, "confid");
	$id = $_SESSION["fid"];
	$_SESSION["done"] = "YES";
	$check = new documents;
	$ret = $check->check_confidential_password(md5($inputpass),$id);
	if($ret != "false"){
		$ret = $check->deleteDocument($id);
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
		$delete = new documents;
		$ret = $delete->deleteDocument($id);
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

if(isset($_POST['save_documents'])){
	$add = new documents;
	/*===================================
	Get the details needed Get the category of the product from a check box inserted into an array
	========================================*/
	$file_id = filter_input(INPUT_POST, "file_id");
	$title = filter_input(INPUT_POST, "title");
	$document = filter_input(INPUT_POST, "document");
	$password = filter_input(INPUT_POST, "confpass");

	/*===================================
	Set the variables to be uploaded
	========================================*/
	$add->setText("title",$title);
	$add->setText("document",$document);
	$ret = $add->check_confidential_password(md5($password),$file_id);
	if($ret != "false"){
		$res = $add->editDocument($file_id);

		if($res == "true"){
			/*============================================================
				Update the working id and address
			===========================================================*/
			$_SESSION["file_id"] = $file_id;
			$_SESSION["file_address"] = str_replace(" ", "-", $title);
			echo"<script>swal('Successful','Changes made. You can view changes by refreshing the page','success');</script>";
		}elseif($res == "false"){
			echo"<script>swal('Sorry','Please Try Again','error');</script>";
		}else{
			echo"<script>swal('Opps!',' $res ','warning');</script>";
		}
	}else{
		echo"<script>swal('Wrong!','Invalid Password','warning');</script>";
	}
}

if(isset($_POST["delete_picture"])){
	$picture_url = filter_input(INPUT_POST, "picture_url");
	$file_id = filter_input(INPUT_POST, "file_id");
	$picture = new documents;
	$ret = $picture->deletefile($file_id,$picture_url);
	if($ret == "true"){
		$_SESSION['message'] = "Picture Deleted";
		echo"<script>swal('Successful','Picture Deleted.','success');</script>";
	}else{
		$_SESSION['message'] = "Error encountered while processing your request. Please try again. ";
		echo"<script>swal('Opps!','Error encountered while processing your request. Please try again.','error');</script>";
	}
}


if(isset($_POST['addotherfile'])){

	$file_id = filter_input(INPUT_POST, "file_id");
	$add = new documents;

	/*===================================
	Create the Folder for the upload.
	========================================*/
	$patharray = array('documents','files');
	$path = $add->createDirectory($patharray);
	$imagepath2 = "";

	/*===================================
	For the post pictures
	========================================*/
	$r2 = $_FILES['files1']['name'][0];

	$count = count($_FILES['files1']['name']);
	if($count >=1){
		if(strlen($r2) - stripos($r2,'.') == 4){
			for($i=0;$i<$count;$i++){
				$myName2 = $_FILES['files1']['name'][$i];
				$myTemp2 = $_FILES['files1']['tmp_name'][$i];
				if($i == 0){
					$imagepath2 .= $add->uploadfile($myName2,$myTemp2,$path,$i);
				}else{
					$imagepath2 .= "#".$add->uploadfile($myName2,$myTemp2,$path,$i);
				}
			}
		}else{
			$imagepath2="";
		}
	}else{
		$imagepath2 = "";
	}
	$res =  $add->add_more_attachment($file_id,$imagepath2);
	if($res == "true"){
		echo"<script>swal('Successfully','Your file was added Successfully','success');</script>";
	}elseif($res == "false"){
		echo"<script>swal('Please Try Again');</script>";
	}else{
		echo"<script>swal('Opps!',' $res ','warning');</script>";
	}
}
?>