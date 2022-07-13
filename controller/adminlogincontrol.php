<?php 
if (isset($_POST['login'])){
	$username = filter_input(INPUT_POST, "username");
	$password = filter_input(INPUT_POST, "password");
	if(!isset($_SESSION['trialnum'])){
		$_SESSION['trialnum'] = 1;
		echo $_SESSION['trialnum'];
	}else{
		$_SESSION['trialnum'] += 1;
	}
	if($_SESSION['trialnum'] > 5){
		$_SESSION['errormessage']="You Have Tried For More Than 5 Times And May Be Blocked Please Be Careful";
		unset($_SESSION['firstpass']);
		header('location:error.php');
	}else{
		if(isset($_SESSION['firstpass'])&& ($_SESSION['firstpass'] =="true")){
			$logg = new login;
			$res = $logg->adminlogin($username,$password);
			if($res=="false"){
				$_SESSION['message'] ="Access Denied!!!";
			}
		}else{
			header('location:login.php');
		}
	}
}
?>