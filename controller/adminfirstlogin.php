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
		$_SESSION['warning'] = "Warning";
		$_SESSION['message']="You Have Tried For More Than 5 Times And May Be Blocked Please Be Careful";
		header('location:error.php');
	}else{
		$logg = new login;
		$res = $logg->adminredirect($username,$password);
		echo $res;
		if($res=="true"){
			header('location:verify.php');
		}elseif($res == "activate"){
			header('location:activation.php');
		}else{
			$_SESSION['message'] = "Unknown username or password";
		}
	}
}
if (isset($_SESSION['message'])) {
	$message = $_SESSION['message'];
}else{
	$message="";
}
?>