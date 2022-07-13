<?php
/**
* 
*/
class uploads extends connection{
	use database, validator,file,format;
	function __construct(){
		$this->file_user = $_SESSION["file_adminId"];
		connection::connecter();
		//creating the table IF it is not already existing
		$this->query="
			CREATE TABLE IF NOT EXISTS `uploads`(
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `file_user` int(11) NOT NULL,
			  `title` varchar(200) NOT NULL,
			  `titlelink` varchar(250) NOT NULL,
			  `category` varchar(200) NOT NULL,
			  `confidential` varchar(5) NOT NULL,
			  `attachment` text,
			  `date_updated` varchar(20) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
		";
		$this->mysqli->query($this->query);
		connection::connecter();
		//creating the table IF it is not already existing
		$this->query="
			CREATE TABLE IF NOT EXISTS `upload_activity`(
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `file_user` varchar(11) NOT NULL,
			  `file_id` varchar(11) NOT NULL,
			  `activity` varchar(11) NOT NULL,
			  `date` varchar(20) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
		";
		$this->mysqli->query($this->query);
		connection::connecter();
		//creating the table IF it is not already existing
		$this->query="
			CREATE TABLE IF NOT EXISTS `uploadconfidpassword`(
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `file_user` varchar(11) NOT NULL,
			  `file_id` varchar(11) NOT NULL,
			  `password` varchar(250) NOT NULL,
			  `date` varchar(20) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
		";
		$this->mysqli->query($this->query);
	}

	public function updateActivity($file_id,$activity){
		$this->date = date('F d, Y');
		/*==Add to the Activity database to help trace the activities in the uploads===*/
		connection::connecter();
		$dataname = array("file_user","file_id","activity","date");
		$datavalues = array($this->file_user,$file_id,$activity,$this->date);
		$result = $this->insertToDatabase("upload_activity",$dataname,$datavalues,"");
		if($result != "false"){
			return true;
		}else{
			return false;
		}
	}
	public function adduploads($filepath){
		connection::connecter();
		$this->filepath = $filepath;
		$this->date = date('F d, Y');
		$this->titlelink = str_replace(" ", "-", $this->title);
		$dataname = array("file_user","title","titlelink","category","attachment","confidential","date_updated");
		$datavalues = array($this->file_user,$this->title,$this->titlelink,$this->category,$this->filepath,$this->confidential,$this->date);

		$this->file_id = $this->insertToDatabase("uploads",$dataname,$datavalues,"");
		if($this->file_id !="false"){
			/*======Add to the confidential database if it was selected confidential======*/
			if($this->confidential == "YES"){
				connection::connecter();
				$dataname = array("file_user","file_id","password","date");
				$datavalues = array($this->file_user,$this->file_id,$this->confpassword,$this->date);
				$result = $this->insertToDatabase("uploadconfidpassword",$dataname,$datavalues,"");
			}
			if($this->updateActivity($this->file_id,"CREATED")){
				return "true";
			}
		}else{
			return "false";
		}
	}
	public function check_confidential_password($pass,$file_id){
		echo $this->file_id =$file_id;
 		echo $this->conf = $pass;
 		echo $this->file_user;
 		connection::connecter();
		return $this->isExist("uploadconfidpassword", "id", "WHERE file_user = '$this->file_user' AND file_id = $this->file_id AND password = '$this->conf'");
	}
	public function deleteupload($id){
		connection::connecter();
		$this->file_id = $id;
		$ret = $this->isExist("uploads","id","WHERE id = '$this->file_id'");
		if($ret != "false"){
			$this->item = array("attachment");
			$res = $this->simpleSelect("uploads",$this->item,"WHERE id = ".$this->file_id);
			if($res != "false"){
				//Delete the associated files
				$this->unlinker($res[0]);
				//delete the confidential password associated to the file if any
				$result = $this->deleteFromDatabase("uploadconfidpassword","file_id",$this->file_id);
				if($result == "true"){
					//delete the upload activities of the file
					$result = $this->deleteFromDatabase("upload_activity","file_id",$this->file_id);
					if($result =="true"){
						//delete the file itself
						$result = $this->deleteFromDatabase("uploads","id",$this->file_id);
						return $result;
					}
				}
			}else{
				return "Please try again";
			}
		}else{
			return"Please select a upload";
		}
	}
	public function getuploads(){
		connection::connecter();
		$this->from = $_SESSION['from'];
		$this->page_rows = $_SESSION['page_rows'];
		$this->items = array("id","title","titlelink","confidential","attachment","date_updated");
		$res = $this->simpleSelect("uploads",$this->items,"WHERE file_user ='$this->file_user' ORDER BY id DESC LIMIT $this->from,$this->page_rows");
		return $res;
	}
	public function searchuploads(){
		$this->from = $_SESSION['from'];
		$this->page_rows = $_SESSION['page_rows'];

		$this->items = array("id","title","titlelink","confidential","attachment","date_updated");
		$this->column = "title";
		$this->searchkeywords = explode(" ", $this->searchitem);
		connection::connecter();
		return $this->simpleSearch2("uploads",$this->column,$this->searchkeywords,$this->items," AND file_user ='$this->file_user' ORDER BY id DESC LIMIT $this->from,$this->page_rows");
	}
	public function relayuploads(){
		if($_SESSION["category"] == "search"){
		 return $this->searchuploads();
		}elseif($_SESSION["category"] == "all"){
			return $this->getuploads();
		}else{
			return $this->getuploadByCategory($_SESSION["category"]);
		}
	}
	public function getuploadByTitle($id){
		connection::connecter();
		$this->file_id = $id;
		$this->items = array("id","title","titlelink","category","attachment","confidential","date_updated");
		$res = $this->simpleSelect("uploads",$this->items,"WHERE id = '$this->file_id' ");
		return $res;
	}
	public function getuploadByCategory($category){
		$this->from = $_SESSION['from'];
		$this->page_rows = $_SESSION['page_rows'];
		connection::connecter();
		$this->category = $category;
		$this->items = array("id");
		
		$extcat = $this->isExist("category","id","WHERE name = '$this->category' AND file_user = '$this->file_user'");
		
		if($extcat != "false"){
			$this->items = array("id","title","titlelink","confidential","attachment","date_updated");
			$this->column = "category";
			$this->searchitem = array($this->category);
			connection::connecter();
			$res = $this->simpleSearch2("uploads",$this->column,$this->searchitem,$this->items,"AND file_user ='$this->file_user' ORDER BY id DESC LIMIT $this->from,$this->page_rows");
			return $res;
		}else{
			return "false";
		}
	}
	public function getcategorypreview(){
		$cat_ret = array();
		connection::connecter();
		$this->items = array("name","planename");
		$ret = $this->simpleSelect("category",$this->items,"WHERE file_user ='$this->file_user' ");
		$co = count($ret);
		for($i=0;$i<=$co-2;$i+=2){
			$cat_ret[] = "<a href = 'uploads.php?ct=$ret[0]'><i class='fa fa-folder'></i>".$ret[1]."</a>";
		}
		return $cat_ret;
	}
	public function getactivities($file_id){
		$this->file_id = $file_id;
		connection::connecter();
		$this->from = $_SESSION['from'];
		$this->page_rows = $_SESSION['page_rows'];
		$this->items = array("id","activity","date");
		$res = $this->simpleSelect("upload_activity",$this->items,"WHERE file_user ='$this->file_user' AND file_id = $this->file_id ORDER BY id DESC LIMIT $this->from,$this->page_rows");
		return $res;
	}


}
?>