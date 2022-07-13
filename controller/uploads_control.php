<?php 
if(isset($_POST['add_uploads'])){
	$add = new uploads;
	/*===================================
	Get the details needed Get the category of the product from a check box inserted into an array
	========================================*/
	$title = filter_input(INPUT_POST, "title");
	$categ = filter_input(INPUT_POST, "category");
	$confidential = filter_input(INPUT_POST, "confidential");
	if($confidential == "YES"){
		$confpass = filter_input(INPUT_POST, "confpassword");
	}else{
		$confpass = "";
	}

	/*===================================
	Upload the picture.
	========================================*/

	/*===================================
	Create the Folder for the upload.
	========================================*/
	$patharray = array('uploads','files');
	$path = $add->createDirectory($patharray);
	$filepath = "";

	if($title!=""&&$category!=""){
		/*===================================
		Set the variables to be uploaded
		========================================*/
		$res = array();
		$add->setText("title",$title);
		$add->setText("category",$categ);
		$add->setText("confidential",$confidential);
		$add->setText("confpassword",md5($confpass));

		/*===================================
		For the post pictures
		========================================*/
		$r2 = $_FILES['attachments']['name'][0];

		$count = count($_FILES['attachments']['name']);
		if($count >=1){
			if((strlen($r2) - stripos($r2,'.') == 4)||(strlen($r2) - stripos($r2,'.') == 5)){
				for($i=0;$i<$count;$i++){
					$myName2 = $_FILES['attachments']['name'][$i];
					$myTemp2 = $_FILES['attachments']['tmp_name'][$i];
						$filepath = $add->uploadfile($myName2,$myTemp2,$path,$i);
						$res[] = $add->adduploads($filepath);
				}
			}else{
				$filepath="";
			}
		}else{
			$filepath = "";
		}
		if(empty($res)){
			echo"<script>swal('Sorry','Correct file format not selected','error');</script>";
		}elseif(! in_array("false",$res)){
			echo"<script>swal('Success','Successfully saved','success');</script>";
		}else{
			echo"<script>swal('Oops!',' Not Successful','warning');</script>";
		}
	}else{
		echo"<script>swal('Oops!','A required information is not given','warning');</script>";
	}

}
?>