<?php
/*=========================================================
This is the category class. Used to group the work based on specialty and classes.
============================================================*/
class category extends connection{
	use database, validator,format;
	function __construct(){
		$this->user = $_SESSION["file_adminId"];
		connection::connecter();
		//creating the table IF it is not already existing
		$this->query="
			CREATE TABLE IF NOT EXISTS `category`(
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `file_user` int(11) NOT NULL,
			  `name` varchar(200) NOT NULL,
			  `planename` varchar(200) NOT NULL,
			  `date_updated` varchar(20) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
		";
		$this->mysqli->query($this->query);
	}
	public function category_Exist($name){
		connection::connecter();
		$res = $this->isExist("category","id","WHERE name = '$name' AND file_user = '$this->user' ");
		return $res;
	}
	public function addCategory(){
		Connection::connecter();
		$this->date = date('F d, Y');
		$existing = $this->category_Exist($this->name);
		if($existing == "false"){
			$dataname = array("file_user","name","planename","date_updated");
			$datavalues = array($this->user,$this->name,$this->planename,$this->date);
			$result = $this->insertToDatabase("category",$dataname,$datavalues,"");
			if($result !="false"){
				return "true";
			}else{
				return "false";
			}
		}else{
			return "Category Already Exists";
		}
	}
	public function deletecategory($id){
		connection::connecter();
		$this->id = $id;
		$ret = $this->isExist("category","id","WHERE id = '$this->id' ");
		if($ret != "false"){
			$result = $this->deleteFromDatabase("category","id",$this->id);
			return $result;
		}else{
			return"Please select a category";
		}
	}
	public function getcategory(){
		connection::connecter();
		$this->from = $_SESSION['from'];
		$this->page_rows = $_SESSION['page_rows'];
		$this->items = array("id","name","planename");
		$res = $this->simpleSelect("category",$this->items,"WHERE file_user = '$this->user' ORDER BY id DESC LIMIT $this->from,$this->page_rows");
		return $res;
	}
	public function listCategory(){
		connection::connecter();
		$this->items = array("id","name","planename");
		$res = $this->simpleSelect("category",$this->items,"WHERE file_user = '$this->user' ORDER BY id DESC");
		return $res;
	}
}
?>