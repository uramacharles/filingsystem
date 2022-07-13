<?php
class login extends connection{
//////////////////////////////////////////////////////
//////////Using the traits needed for the work
////////////////////////////////////////////////////
	use database,validator;
	function __construct(){
		connection::connecter();
		/*==========================================
		Create the database of the admin in the first instant when the class is called
		===========================================*/
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
	/*==========================================
	The First level Login function. For account Initiation.
	===========================================*/
	public function adminredirect($username,$password){
		connection::connecter();
		$this->un = $username;
		$this->pa = md5($password);
		$res = $this->isExist("admintable","id","WHERE username1 = '$this->un' AND password1 = '$this->pa'");
		if($res == 1){
			$ret = $this->isExist("admintable","id","WHERE username1 = '$this->un' AND password1 = '$this->pa' AND active = 'YES' ");
			if($ret == 1){
				$_SESSION['firstpass'] = "true";
				unset($_SESSION['message']);
				return "true";
			}else{
				$_SESSION['message'] = "Account is not yet active. Please do well to activate your account soon.";
				return "activate";
			}
		}else{
			return "false";
		}
	}
	/*==========================================
	The Second level Login function. For account verification.
	===========================================*/
	public function adminlogin($username,$password){
		connection::connecter();
		$this->un = $username;
		$this->pa = md5($password);
		$this->items = array("id","name","email");
		$ret = $this->isExist("admintable","id","WHERE username2 = '$this->un' AND password2 = '$this->pa' AND active = 'YES' ");
		if($ret == 1){
			$res = $this->simpleSelect("admintable",$this->items,"WHERE username2 = '$this->un' AND password2 = '$this->pa' AND active = 'YES'");
			if($res != "false"){
				$_SESSION['file_adminId'] = $res[0];
				$_SESSION['file_admin_name'] = $res[1];
				$_SESSION['file_admin_email'] = $res[1];
				$_SESSION['file_state'] = 'Logout';
				unset($_SESSION['trialnum']);
				header('location:adminboard.php');
			}else{
				return "false";
			}
		}else{
			return "false";
		}
	}
	/*==========================================
	The Logout function
	===========================================*/
	public function logout(){
		connection::connecter();
		session_destroy();
		$_SESSION['file_state']="Login";
		header('location:index.php');
	}
	/*==========================================
	Redirects to login page
	===========================================*/
	public function tologin(){
		connection::connecter();
		session_destroy();
		$_SESSION['file_state']="Login";
		header('location:login.php');
	}
}
?>