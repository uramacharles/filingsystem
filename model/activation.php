<?php 
/**
 * 
 */
class activation extends connection{
	
//////////////////////////////////////////////////////
//////////Using the traits needed for the work
////////////////////////////////////////////////////
	use database, validator,format,mailer;
	function __construct(){
		connection::connecter();
		//creating the table IF it is not already existing
		$this->date = time();
		$this->chec = time();
		$this->date_exp = $this->date +600;
		//creating the table IF it is not already existing
		$this->query="
			CREATE TABLE IF NOT EXISTS `activation` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `email` varchar(50) NOT NULL,
			  `activation_code` varchar(10) NOT NULL,
			  `date` varchar(50) NOT NULL,
			  `date_exp` varchar(50) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
		";
		$this->mysqli->query($this->query);
	}
	public function sendCode($code){
		connection::connecter();
		$this->codetosend = $code;
		$subject = "Activation Code:";
		$from = "Law-firm File Database";
		$message = "<h1> Kindly type in the following code in the activation page so as to enable you login to your Dashboard.<br/> ".$this->codetosend."</h1>";
		$res = $this->sendMail($subject,$message,$from,$this->email);
		return $res;
	}
	/*==================================================================
		For Account activation
	==============================================================*/
	public function sendActivationCode(){
		connection::connecter();
		$_SESSION['email'] = $this->email;
		unset($_SESSION['trialnum']);
		$this->date = date('F d, Y');
		$ret = $this->isExist("admintable","id","WHERE email = '$this->email'");
		if($ret != "false"   ){
			$ret = $this->isExist("activation","id","WHERE email = '$this->email'");
			$this->codetosend = rand(1000,9999999999);
			$dataname = array("email","activation_code","date","date_exp");
			$datavalues = array($this->email,$this->codetosend,$this->date,$this->date_exp);
			if($ret != "false"   ){
				$result = $this->updateDatabase("activation",$dataname,$datavalues,"");
				
				$this->sendCode($this->codetosend);

				return "<script>swal('Successful','A activation code have been sent to your email.','email');</script>";
			}else{
				$result = $this->insertToDatabase("activation",$dataname,$datavalues,"");

				$this->sendCode($this->codetosend);

				return "<script>swal('Successful','A activation code have been sent to your email.','email');</script>";
			}
		}else{
			return "<script>swal('Not Successful','The email address supplied is not registered in this site.','error');</script>";
		}
	}
	public function resendActivationCode(){
		connection::connecter();
		unset($_SESSION['trialnum']);
		$this->date = date('F d, Y');
		$this->email = $_SESSION['email'];
		$ret = $this->isExist("admintable","id","WHERE email = '$this->email'");
		if($ret != "false"   ){
			$this->codetosend = rand(1000,9999999999);
			$dataname = array("email","activation_code","date","date_exp");
			$datavalues = array($this->email,$this->codetosend,$this->date,$this->date_exp);
			$result = $this->updateDatabase("activation",$dataname,$datavalues,"");
			$this->sendCode($this->codetosend);
			return "<script>swal('Successful','Another activation code have been sent to your email.','email');</script>";	 
		}else{
			return "<script>swal('Not Successful','The email address supplied is not registered in this site.','error');</script>";
		}
	}
	public function validateActivation(){
		connection::connecter();
		$this->items = array("activation_code");
		$this->email = $_SESSION['email'];
		$res = $this->simpleSelect("activation",$this->items,"WHERE email = '$this->email'");
		$this->sentcode = $res[0];
		if($this->activation_code == $this->sentcode ){
			$dataname = array("active");
			$datavalues = array("YES");
			$result = $this->updateDatabase("admintable",$dataname,$datavalues,"WHERE email = '$this->email'");
			if($result != "false" ){
				return "<script>swal('Successful','Successful. You can now login','success');</script>";
			}else{
				return "<script>swal('Not Successful','Try again','error');</script>";				
			}
		}else{
			return "<script>swal('Not Successful','Wrong activation code','error');</script>";	
		}
	}
	public function deleteActivation(){
		connection::connecter();
		/*===================================================================
		Delete the activation code from the activation table when the time have expired
		========================================================================*/
		$this->chec = time();
		$this->deleteExpiredFromDatabase("activation","date_exp",$this->chec);
	}
}



 ?>