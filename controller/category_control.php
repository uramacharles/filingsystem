<?php
if(isset($_POST['addcategory'])){
	$add = new category;
	/*===================================
	Get the details needed Get the category of the product from a check box inserted into an array
	========================================*/
	$name = filter_input(INPUT_POST, "name");
	$add->setText("name",str_replace(" ", "-", $name));
	$add->setText("planename", $name);
	$res = $add->addCategory();
	if($res == "true"){
		echo"<script>swal('Successfully added');</script>";
	}elseif($res == "false"){
		echo"<script>swal('Please Try Again');</script>";
	}else{
		echo"<script>swal('Opps!',' $res ','warning');</script>";
	}
}
if (isset($_POST["delete_category"])) {
	$id = filter_input(INPUT_POST, "categoryid");
	$delete = new category;
	$ret = $delete->deletecategory($id);
	if($ret == "true"){
		$_SESSION['message'] = "Successfully removed from the list ";
		echo"<script>swal('Successful','Successfully removed from the list.','success');</script>";
	}else{
		$_SESSION['message'] = "Error encountered while processing your request. Please try again. ";
		echo"<script>swal('Opps!','".$ret."','error');</script>";
	}
}


?>