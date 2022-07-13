<?php
/*
Items set and validated
#password for login # password for registeration # Email address for registeration # Address #business # phone Number # Texts # Selected # Name (Surname, First name , Last Name) # single name
*/
trait validator{
	public $firstname;
	public $lastname;
	public $email;
	public $phone;
	public $newName;
	public $password;
	public $reporter;
	public $posReport;
	public $report = array();
	public $errormessage = array();
	public function setPassword($password,$retpassword){
		$this->password= $password;
		$this->retpassword = $retpassword;
		$this->validatePassword();
	}
	public function setEmail($email,$retemail){
		$this->email = $email;
		$this->retemail = $retemail;
		$this->validateEmail();
	}
	public function setAddress($address){
		$this->address = $address;
		$this->validateAddress($this->address);
	}
	public function setBusiness($business){
		$this->business = $business;
		$this->validateBusiness($this->business);
	}
	public function setPhonenumber($phonenumber){
		$this->phonenumber = $phonenumber;
		$this->validatePhone($this->phonenumber);
	}
	public function setText($name,$text){
		$this->$name = $text;
		$this->validateText($this->$name);
	}
	public function setAmount($name){
		$this->amount = $name;
		$this->validateAmount();
	}
	public function setLetterEmail($email){
		$this->email = $email;
		$this->validateLetterEmail();
	}
	public function setName($surname,$firstname,$lastname){
		$this->surname = $surname;
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->validateName($this->surname);
		$this->validateName($this->firstname);
		$this->validateName($this->lastname);
	}
	public function setSingleName($name,$value){
		$this->$name = $value;
		$this->validateName($this->$name);
	}
	public function setUsername($user){
		$this->username = $user;
		$this->validateUsername();
	}
	public function setLogPass($p){
		$this->password = $p;
		$this->validateLogPass();
	}
	public function setSelected($name,$value){
		$this->$name = $value;
		$this->validateSelected($name,$value);
	}
	public function setOptional($name,$text){
		$this->$name = $text;
		$this->validateOptional($this->$name);
	}
	public function validateLetterEmail(){
		if(preg_match("/[a-zA-Z0-9]*@[a-zA-Z]*.[a-z]*$/",$this->email)){
			$this->report[] ="true";
			$this->errormessage[]="";
		}else{
			$this->report[] = "false";
			$this->errormessage[]="This is an invalid email address."; 
		}		
	}
  	public function validateLogPass(){
		if(is_null($this->password)){
			$this->report[] = "false";
			$this->errormessage[] ="Wrong username or password";			
		}else{
			$this->report[]="true";
			$this->errormessage[]="";
			$this->password = md5($this->password);
		}
	}
	function validateText($name){
		//for the name
		connection::connecter();
		$this->text= $name;
		if($this->text==""){
			$this->report[]="false";
			$this->errormessage[]="cannot have an empty name";
		}else{
			//add a regular expression to check if there is a number in it
			//$this->text = $this->mysqli->escape_string($this->text);
			$this->report[] = "true";
			$this->errormessage[]="";
		}
	}
	function validateAmount(){
		if($this->amount ==""){
			$this->report[]="false";
			$this->errormessage[]="";
		}else{
			$this->report[] = "true";
			$this->errormessage[]="";
		}
	}
	function validateOptional($name){
		connection::connecter();
		$this->text= $name;
		if($this->text==""){
			$this->report[]="true";
			$this->errormessage[]="";
		}else{
			//add a regular expression to check if there is a number in it
			$this->text = $this->mysqli->escape_string($this->text);
			$this->report[] = "true";
			$this->errormessage[]="";
		}
	}
	function validatePhone(){
		//for phone number
		if($this->phonenumber !=""&&is_numeric($this->phonenumber)&& (strlen($this->phonenumber)>10)&&(strlen($this->phonenumber)<15)){
			$this->report[]="true";
			$this->errormessage[]="";
		}else{
			$this->report[]="false";
			$this->errormessage[]="phone number not recognized";
		}
	}
	public function validateName($name){
		$this->name= $name;
		if($this->name==""){
			$this->report[]="false";
			$this->errormessage[]="cannot have an empty name";
		}else{
			//add a regular expression to check if there is a number in it
			if(ctype_alpha($this->name)){
				$this->report[]="true";
				$this->errormessage[]="";
			}else{
				$this->report[]="false";
				$this->errormessage[]="your names must be made up of alphabets only.";
			}
		}
	}
	function validateAddress($address){
		connection::connecter();
		$this->address= $address;
		if($this->address==""){
			$this->report[]="false";
			$this->errormessage[]="cannot have an empty description";
		}else{
			//add a regular expression to check if there is a number in it
			$this->address = $this->mysqli->escape_string($this->address);
		}
	}
	function validateUsername(){
		connection::connecter();
		if($this->username==""){
			$this->report[]="false";
			$this->errormessage[]="Username not recognized";
		}else{
			//add a regular expression to check if there is a number in it
			$this->username = $this->mysqli->escape_string($this->username);
		}
	}
	function validateBusiness($business){
		connection::connecter();
		$this->business= $business;
		if($this->business==""){
			$this->report[]="false";
			$this->errormessage[]="cannot have an empty description";
		}else{
			//add a regular expression to check if there is a number in it
			$this->business = $this->mysqli->escape_string($this->business);
		}
	}
	function validatePassword(){
		if(($this->password === $this->retpassword)){
			$this->report[]="true";
			$this->errormessage[]="";
			$this->password =md5($this->password);
		}else{
			$this->report[]="false";
			$this->errormessage[]="your password did not match";
		}
	}
	function validateEmail(){
		//for the email
		if($this->email === $this->retemail){
			if(preg_match("/[a-zA-Z0-9]*@[a-zA-Z]*.[a-z]*$/",$this->email)){
				$this->report[] ="true";
				$this->errormessage[]="";
			}else{
				$this->report[] = "false";
				$this->errormessage[]="This is an invalid email address."; 
			}
		}else{
				$this->report[] = "false";
				$this->errormessage[]="The email address did not match."; 
		}
	}
	function validateSelected($name,$value){
		$this->checked = $value;
		if($this->checked !=""){
			$this->report[] ="true";
			$this->errormessage[]="";
		}else{
			$this->report[] ="false";
			$this->errormessage[]="Please ".$name." is needed."; 
		}
	}
	public function getResult(){
		$count=sizeof($this->report);
		for($i=0;$i<$count;$i++){
			if($this->report[$i]=="false"){
				if($i==1){
					$this->reporter = "<span>".$this->errormessage[$i]."<span><br/>";					
				}else{
					$this->reporter .= "<span>".$this->errormessage[$i]."<span><br/>";
				}

			}else{
				$this->posReport = "true";
				continue;
			}
		}
		return $this->reporter.$this->posReport;
	}
}
?>