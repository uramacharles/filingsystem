<?php
class connection{
	public $username,$pword,$host,$database;public $mysqli;
	function connecter(){
		$this->username = "uramacharles";
		$this->pword = "uramacopy";
		$this->host = "localhost";
		$this->database = "filedatabase";
		$this->mysqli = new mysqli($this->host,$this->username,$this->pword,$this->database);
	}
	function __distruct(){
		$this->mysqli->close();
	}
}
?>