<?php
/**
* 
*/
class documents extends connection{
	use database, validator,file,format;
	function __construct(){
		$this->file_user = $_SESSION["file_adminId"];
		connection::connecter();
		//creating the table IF it is not already existing
		$this->query="
			CREATE TABLE IF NOT EXISTS `documents`(
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `file_user` int(11) NOT NULL,
			  `title` varchar(200) NOT NULL,
			  `titlelink` varchar(250) NOT NULL,
			  `document` text NOT NULL,
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
			CREATE TABLE IF NOT EXISTS `document_activity`(
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
			CREATE TABLE IF NOT EXISTS `confidpassword`(
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
		/*==Add to the Activity database to help trace the activities in the documents===*/
		connection::connecter();
		$dataname = array("file_user","file_id","activity","date");
		$datavalues = array($this->file_user,$file_id,$activity,$this->date);
		$result = $this->insertToDatabase("document_activity",$dataname,$datavalues,"");
		if($result != "false"){
			return true;
		}else{
			return false;
		}
	}
	public function addDocuments($filepath){
		connection::connecter();
		$this->filepath = $filepath;
		$this->date = date('F d, Y');
		$this->titlelink = str_replace(" ", "-", $this->title);
		$dataname = array("file_user","title","titlelink","document","category","attachment","confidential","date_updated");
		$datavalues = array($this->file_user,$this->title,$this->titlelink,$this->document,$this->category,$this->filepath,$this->confidential,$this->date);

		$this->file_id = $this->insertToDatabase("documents",$dataname,$datavalues,"");
		if($this->file_id !="false"){
			/*======Add to the confidential database if it was selected confidential======*/
			if($this->confidential == "YES"){
				connection::connecter();
				$dataname = array("file_user","file_id","password","date");
				$datavalues = array($this->file_user,$this->file_id,$this->confpassword,$this->date);
				$result = $this->insertToDatabase("confidpassword",$dataname,$datavalues,"");
			}
			if($this->updateActivity($this->file_id,"CREATED")){
				return "true";
			}
		}else{
			return "false";
		}
		
	}
	public function check_confidential_password($pass,$file_id){
		$this->file_id =$file_id;
 		$this->conf = $pass;
 		$this->file_user;
 		connection::connecter();
		return $this->isExist("confidpassword", "id", "WHERE file_user = '$this->file_user' AND file_id = $this->file_id AND password = '$this->conf'");
	}
	public function deleteDocument($id){
		connection::connecter();
		$this->file_id = $id;
		$ret = $this->isExist("documents","id","WHERE id = '$this->file_id'");
		if($ret != "false"){
			$this->item = array("attachment");
			$res = $this->simpleSelect("documents",$this->item,"WHERE id = ".$this->file_id);
			if($res != "false"){
				//Delete the associated files
				$this->unlinker($res[0]);
				//delete the confidential password associated to the file if any
				$result = $this->deleteFromDatabase("confidpassword","file_id",$this->file_id);
				if($result == "true"){
					//delete the document activities of the file
					$result = $this->deleteFromDatabase("document_activity","file_id",$this->file_id);
					if($result =="true"){
						//delete the file itself
						$result = $this->deleteFromDatabase("documents","id",$this->file_id);
						return $result;
					}
				}
			}else{
				return "Please try again";
			}
		}else{
			return"Please select a document";
		}
	}
	public function editDocument($id){
		$this->file_id = $id;
		$this->date = date('F d, Y');
		$this->titlelink = str_replace(" ", "-", $this->title);
		connection::connecter();
		$dataname = array("title","titlelink","document","date_updated");
		$datavalues = array($this->title,$this->titlelink,$this->document,$this->date);
		$result = $this->updateDatabase("documents",$dataname,$datavalues,"WHERE id = '$this->file_id'");
		if($result =="true"){
			if($this->updateActivity($this->file_id,"Edited The File")){
				return "true";
			}
		}else{
			return "false";
		}
	}
	public function deletefile($file_id,$filepath){
		connection::connecter();
		$this->filepath = $filepath;
		$this->file_id = $file_id;
		$this->date = date('F d, Y');
		$this->items = array("attachment");
		/*========================================
			Select the Old concatenated urls
		===========================================*/
		$res = $this->simpleSelect("documents",$this->items,"WHERE id='$this->file_id'");
		if($res!="false"){
			/*====================================================================================
				REMOVE THE DELETED URL FROM THE CONCATENATED STRINGS TO GET AN UPDATED STRING.
			========================================================================================*/	
			$this->oldpath = $res[0];
			$this->newpath = str_replace($filepath, "", $this->oldpath);
			$this->newpath = str_replace("##", "#", $this->newpath);
			
			if($this->newpath[0] == "#"){
				$this->newpath[0] = "";
			}
			$cn = strlen($this->newpath);
			if($this->newpath[$cn-1] == "#"){
				$this->newpath[$cn-1] = "";
			}

			$this->newpath = ltrim($this->newpath);
			$this->newpath = rtrim($this->newpath);
			
			/*====================================================
				Update the database with the new url.
			===========================================================*/

			$dataname = array("attachment","date_updated");
			$datavalues = array($this->newpath,$this->date);
			$result = $this->updateDatabase("documents",$dataname,$datavalues,"WHERE id = '$this->file_id'");
			if($result !="false"){
				/*===========================================================
					If the update is successful, then we delete the picture.
				==============================================================*/
				unlink($this->filepath);
				if($this->updateActivity($this->file_id,"DELETED A FILE")){
					return "true";
				}
			}else{
				return "false";
			}
		}else{
			return "false";
		}
	}
	public function add_more_attachment($id,$filepath){
		connection::connecter();
		$this->filepath = $filepath;
		$this->file_id = $id;
		$this->date = date('F d, Y');
		$this->items = array("attachment");
		$res =$this->simpleSelect("documents",$this->items,"WHERE id='$this->file_id'");
		if($res!="false"){
			$this->oldpath = $res[0];
			$this->filepath = ltrim($this->oldpath."#".$this->filepath);
			if($this->filepath[0] == "#"){
				$this->filepath[0] = "";
			}
			$this->date = date('F d, Y');
			$dataname = array("attachment","date_updated");
			$datavalues = array($this->filepath,$this->date);
			connection::connecter();
			$result = $this->updateDatabase("documents",$dataname,$datavalues,"WHERE id = '$this->file_id'");
			if($result !="false"){connection::connecter();
				if($this->updateActivity($this->file_id,"ADDED MORE ATTACHMENT")){
					return "true";
				}
			}else{
				return "false";
			}
		}else{
			return "false";
		}
	}
	public function getDocuments(){
		connection::connecter();
		$this->from = $_SESSION['from'];
		$this->page_rows = $_SESSION['page_rows'];
		$this->items = array("id","title","titlelink","confidential","date_updated");
		$res = $this->simpleSelect("documents",$this->items,"WHERE file_user ='$this->file_user' ORDER BY id DESC LIMIT $this->from,$this->page_rows");
		return $res;
	}
	public function searchDocuments(){
		$this->from = $_SESSION['from'];
		$this->page_rows = $_SESSION['page_rows'];

		$this->items = array("id","title","titlelink","confidential","date_updated");
		$this->column = "title";
		$this->searchkeywords = explode(" ", $this->searchitem);
		connection::connecter();
		return $this->simpleSearch2("documents",$this->column,$this->searchkeywords,$this->items," AND file_user ='$this->file_user' ORDER BY id DESC LIMIT $this->from,$this->page_rows");
	}
	public function relayDocuments(){
		if($_SESSION["category"] == "search"){
		 return $this->searchDocuments();
		}elseif($_SESSION["category"] == "all"){
			return $this->getDocuments();
		}else{
			return $this->getDocumentByCategory($_SESSION["category"]);
		}
	}
	public function getDocumentByTitle($title,$id){
		connection::connecter();
		$this->title = $title;
		$this->file_id = $id;
		$this->items = array("id","title","titlelink","document","category","attachment","confidential","date_updated");
		$res = $this->simpleSelect("documents",$this->items,"WHERE titlelink = '$this->title' AND id = '$this->file_id' ");
		return $res;
	}
	public function getFiles($id){
		connection::connecter();
		$this->file_id = $id;
		$result = array();
		$this->items = array("attachment");
		$res = $this->simpleSelect("documents",$this->items,"WHERE file_user = '$this->file_user' AND id = '$this->file_id'");
		$result = explode("#",$res[1]);
		$result[] = $res[0];
		return $result;
	}
	public function getDocumentByCategory($category){
		$this->from = $_SESSION['from'];
		$this->page_rows = $_SESSION['page_rows'];
		connection::connecter();
		$this->category = $category;
		$this->items = array("id");
		
		$extcat = $this->isExist("category","id","WHERE name = '$this->category' AND file_user = '$this->file_user'");
		
		if($extcat != "false"){
			$this->items = array("id","title","titlelink","confidential","date_updated");
			$this->column = "category";
			$this->searchitem = array($this->category);
			connection::connecter();
			$res = $this->simpleSearch2("documents",$this->column,$this->searchitem,$this->items,"AND file_user ='$this->file_user' ORDER BY id DESC LIMIT $this->from,$this->page_rows");
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
			$cat_ret[] = "<a href = 'documents.php?ct=$ret[$i]'><i class='fa fa-folder'></i>".$ret[$i+1]."</a>";
		}
		return $cat_ret;
	}
	public function getactivities($file_id){
		$this->file_id = $file_id;
		connection::connecter();
		$this->from = $_SESSION['from'];
		$this->page_rows = $_SESSION['page_rows'];
		$this->items = array("id","activity","date");
		$res = $this->simpleSelect("document_activity",$this->items,"WHERE (file_user ='$this->file_user' AND file_id=$this->file_id) ORDER BY id DESC LIMIT $this->from,$this->page_rows");
		return $res;
	}
}
?>