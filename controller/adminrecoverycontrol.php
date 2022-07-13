<?php
	$data = new recovery;
	$data->deleteRecovery();
	
	if (isset($_POST['sendcode'])){
		$email =filter_input(INPUT_POST, "recoveryemail");
		$data = new recovery;
		$data->setText("email",$email);
		$ret = $data->sendRecoveryCode();
		echo $ret;
	}
	if (isset($_POST['recover'])){
		if(!isset($_SESSION['trialnum'])){
			$_SESSION['trialnum'] = 1;
			echo $_SESSION['trialnum'];
		}else{
			$_SESSION['trialnum'] += 1;
		}
		if($_SESSION['trialnum'] >=3){
			$data = new recovery;
			$res = $data->resendRecoveryCode();
			echo $res;
		}else{
			$recoverycode =filter_input(INPUT_POST, "recoverycode");
			$newpassword =filter_input(INPUT_POST, "newpassword");
			$retrynewpassword =filter_input(INPUT_POST, "retrynewpassword");
			$data = new recovery;
			$data->setText("recoverycode",$recoverycode);
			$data->setPassword($newpassword,$retrynewpassword);
			$ret = $data->validateRecovery($_SESSION['email']);
			echo $ret;
		}
	}
?>