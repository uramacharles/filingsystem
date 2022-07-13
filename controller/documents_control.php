<?php 
if(isset($_POST['add_documents'])){
	$add = new documents;
	/*===================================
	Get the details needed Get the category of the product from a check box inserted into an array
	========================================*/
	$title = filter_input(INPUT_POST, "title");
	$document = filter_input(INPUT_POST, "document");
	$categ = filter_input(INPUT_POST, "category");
	$confidential = filter_input(INPUT_POST, "confidential");
	if($confidential == "YES"){
		echo $confpass = filter_input(INPUT_POST, "confpassword");
	}else{
		$confpass = "";
	}

	/*===================================
	Upload the picture.
	========================================*/

	/*===================================
	Create the Folder for the upload.
	========================================*/
	$patharray = array('documents','files');
	$path = $add->createDirectory($patharray);
	$filepath = "";

	/*===================================
	For the post pictures
	========================================*/
	$r2 = $_FILES['attachments']['name'][0];

	$count = count($_FILES['attachments']['name']);
	if($count >=1){
		if(strlen($r2) - stripos($r2,'.') == 4){
			for($i=0;$i<$count;$i++){
				$myName2 = $_FILES['attachments']['name'][$i];
				$myTemp2 = $_FILES['attachments']['tmp_name'][$i];
				if($i == 0){
					$filepath .= $add->uploadfile($myName2,$myTemp2,$path,$i);
				}else{
					$filepath .= "#".$add->uploadfile($myName2,$myTemp2,$path,$i);
				}
			}
		}else{
			$filepath="";
		}
	}else{
		$filepath = "";
	}
	/*===================================
	Set the variables to be uploaded
	========================================*/
	$add->setText("title",$title);
	$add->setText("document",$document);
	$add->setText("category",$categ);
	$add->setText("confidential",$confidential);
	$add->setText("confpassword",md5($confpass));

	if($title!=""&&$category!=""&&$document !="<br>"){

		$res = $add->addDocuments($filepath);
		if($res == "true"){
			echo"<script>swal('Success','Successfully saved','success');</script>";
		}elseif($res == "false"){
			echo"<script>swal('Sorry','Please Try Again','error');</script>";
		}else{
			echo"<script>swal('Oops!',' $res ','warning');</script>";
		}
	}else{
		echo"<script>swal('Oops!','A required information is not given','warning');</script>";
	}

}


?>