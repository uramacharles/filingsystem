<?php
	$data = new activation;
	$data->deleteActivation();
	
	if (isset($_POST['sendcode'])){
		$email =filter_input(INPUT_POST, "activationemail");
		$data = new activation;
		$data->setText("email",$email);
		$ret = $data->sendActivationCode();
		echo $ret;
	}
	if (isset($_POST['activate'])){
		if(!isset($_SESSION['trialnum'])){
			$_SESSION['trialnum'] = 1;
			echo $_SESSION['trialnum'];
		}else{
			$_SESSION['trialnum'] += 1;
		}
		if($_SESSION['trialnum'] >=3){
			$data = new activation;
			$res = $data->resendActivationCode();
			echo $res;
		}else{
			$activationcode =filter_input(INPUT_POST, "activationcode");
			$data = new activation;
			$data->setText("activation_code",$activationcode);
			$ret = $data->validateActivation($_SESSION['email']);
			echo $ret;
		}
	}

?>