<?php
/**
* This class is used to register the users.
*/
class register extends connection{
//////////////////////////////////////////////////////
//////////Using the traits needed for the work
////////////////////////////////////////////////////
	use database, validator,format,mailer,file;
	function __construct(){
		connection::connecter();
		if(isset($_SESSION["file_adminId"])){
			$this->file_user = $_SESSION['file_adminId'];
		}
		//creating the table IF it is not already existing
		$this->query="
			CREATE TABLE IF NOT EXISTS `admintable`(
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `name` varchar(70) NOT NULL,
			  `username1` varchar(100) NOT NULL,
			  `username2` varchar(100) NOT NULL,
			  `password1` varchar(100) NOT NULL,
			  `password2` varchar(100) NOT NULL,
			  `email` varchar(50) NOT NULL,
			  `chamber_name` varchar(50) ,
			  `imagepath` varchar(70),
			  `description` text,
			  `active` varchar(5) NOT NULL,
			  `date` varchar(20) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
		";
		$this->mysqli->query($this->query); 
	}
	public function adadmin(){
		connection::connecter();
		$this->rep = $this->getResult();
		if($this->rep == "true"){
			$this->username1 = $this->username2 = $this->username;
			$this->password1 = $this->password2 = $this->password;
			$this->date = date('F m, Y');
			$isexist = $this->isExist("admintable","id","WHERE username1 = '$this->username1' OR username2 ='$this->username2'");
			if($isexist != "false"){
				return "<script>swal('Not Successful','User Already Existing','error');</script>";
			}else{
				$dataname = array("name","username1","password1","username2","password2","email","chamber_name","imagepath","description","active","date");
				$datavalues = array($this->name,$this->username1,$this->password1,$this->username2,$this->password2,$this->email,"","","","NO",$this->date);
				if($result = $this->insertToDatabase("admintable",$dataname,$datavalues,"")){
					return "true";
				}else{
					return "false";
				}
			}
		}
	}
	public function adminPreviewProfile(){
		connection::connecter();
		$this->items = array("id","name","email","chamber_name","imagepath","description","date");
		$res = $this->simpleSelect("admintable",$this->items,"WHERE id = '$this->file_user'");
		return $res;
	}
	public function adminFetchProfile(){
		connection::connecter();
		$this->items = array("id","name","username1","username2","date","email","chamber_name","imagepath","description");
		$res = $this->simpleSelect("admintable",$this->items,"WHERE id = '$this->file_user'");
		return $res;
	}
	public function editAdminAccess1(){
		connection::connecter();
		/*======================================================================
		This will edit the admin username and password of the first access
		=========================================================================*/
		$this->date = date('F d, Y');
		$isexist =$this->isExist("admintable","id","WHERE username1 = '$this->username1' AND password1 = '$this->old_password1'");
		if($isexist != "false"){
			$dataname = array("username1","password1","date");
			$datavalues = array($this->username1,$this->password1,$this->date);
			return $result = $this->updateDatabase("admintable",$dataname,$datavalues,"WHERE id = '$this->file_user'");
		}else{		
			return "<script>swal('Not Successful','User Already Existing','error');</script>";
		}
	}
	public function editAdminAccess2(){
		connection::connecter();
		/*======================================================================
		This will edit the admin username and password of the first access
		=========================================================================*/
		$this->date = date('F d, Y');
		$isexist =$this->isExist("admintable","id","WHERE username2 = '$this->username2' AND password2 = '$this->old_password2'");
		if($isexist != "false"){
			$dataname = array("username2","password2","date");
			$datavalues = array($this->username2,$this->password2,$this->date);
			return $result = $this->updateDatabase("admintable",$dataname,$datavalues,"WHERE id = '$this->file_user'");
		}else{		
			return "<script>swal('Not Successful','User Already Existing','error');</script>";
		}
	}
	public function editAdminInfo(){
		connection::connecter();
		/*======================================================================
		This function is also meant to fetch the pix path of a reviewer from his email address
		then insert the path to the database
		=========================================================================*/
		$this->date = date('F d, Y');
		$dataname = array("name","chamber_name","description","date");
		$datavalues = array($this->name,$this->chamber_name,$this->description,$this->date);
		return $result = $this->updateDatabase("admintable",$dataname,$datavalues,"WHERE id = '$this->file_user'");
	}
	public function editAdminEmail(){
		connection::connecter();
		/*======================================================================
		This function is also meant to fetch the pix path of a reviewer from his email address
		then insert the path to the database
		=========================================================================*/
		$this->date = date('F d, Y');
		$dataname = array("email","date");
		$datavalues = array($this->email,$this->date);
		$result = $this->updateDatabase("admintable",$dataname,$datavalues,"WHERE id = '$this->file_user'");
		if($result !="false"){
			return "<script>swal('Successful.',  'Admin Email Have been Updated', 'success');</script>";
		}else{
			return "<script>swal('Not Successful','Please try again','error');</script>";
		}	
	}
	public function editPix($imagepath){
		connection::connecter();
		$this->imagepath = $imagepath;
		$this->date = date('F d, Y');
		$this->items = array("imagepath");
		$res = $this->simpleSelect("admintable",$this->items," WHERE id ='$this->file_user' ");
		if($res!="false"){
			$this->oldpath = $res[0];
			$dataname = array("imagepath","date");
			$datavalues = array($this->imagepath,$this->date);
			connection::connecter();
			$result = $this->updateDatabase("admintable",$dataname,$datavalues," WHERE id = '$this->file_user' ");
			if($result !="false"){
				//unlink($this->oldpath);
				return "true";
			}else{
				return "false";
			}
		}else{
			return "false";
		}
	}
	public function deleteRecovery(){
		connection::connecter();
		/*===================================================================
		Delete the activation code from the activation table when the time have expired
		========================================================================*/
		$this->chec = time();
		$this->deleteExpiredFromDatabase("recovery","date_exp",$this->chec);
	}
}
?>