<?php
trait database {
public $selected = array();
	private function setInsertQueryString($dataname,$datavalues){
		$str1 = "(";
		$str2 = "VALUES(";
		if(is_array($dataname)){
			if(count($dataname)==count($datavalues)){
				$num = count($dataname);
				for($i=0;$i<$num;$i++){
					if($i==0){
						$str1.= $dataname[$i];
						$str2.= "'".$datavalues[$i]."'";
					}else{
						$str1.=",".$dataname[$i];
						$str2.=",'".$datavalues[$i]."'";
					}
				}
				$str1.=") ";
				$str2.=")";
				return $str1.$str2;
			}else{
				return "false";
			}
		}else{
			$str1.=$dataname[$i];
			$str2.="'".$datavalues[$i]."'";
			$str1.=")";
			$str2.=")";
			return $str1.$str2;
		}
	}
	private function setUpdateQueryString($dataname,$datavalues){
		if(is_array($dataname)){
			if(count($dataname)==count($datavalues)){
				$num = count($dataname);
				$str1 = "";
				for($i=0;$i<$num;$i++){
					if($i==0){
						$str1.=$dataname[$i]." = '".$datavalues[$i]."'";
					}else{
						$str1.= ",".$dataname[$i]." = '".$datavalues[$i]."'";
					}
				}
				return $str1;
			}else{
				return "false";
			}
		}else{
			$str1 .=$dataname[$i]." = '".$datavalues[$i]."'";
			return $str1;
		}
	}
	private function setItems($items){
		if(is_array($items)){
				$num = count($items);
				$str1 = "";
				for($i=0;$i<$num;$i++){
					if($i==0){
						$str1 .=$items[$i];
					}else{
						$str1 .= ",".$items[$i];
					}
				}
				return $str1;
		}else{
			return $items;
		}
	}
	public function setSearchItems($columns,$items){
 		if($items!=""){
 			$b=1;
 			$this->construct ="(";
	 		foreach ($items as $value){
	 			if ($b == 1 ) {
					$this->construct .="$columns LIKE '%$value%'";
	 			}else{
					$this->construct .=" OR $columns LIKE '%$value%'";
	 			}
	 			$b++;
	 		}
	 		$this->construct .= ")";
	 		return $this->construct;
 		}else{
 			return "false";
 		}
 	}
	public function insertToDatabase($database,$dataname,$datavalues,$condition){
		connection::connecter();
		$this->querystring = $this->setInsertQueryString($dataname,$datavalues);
		$this->condition = $condition;
		if($this->querystring != "false"){
			$this->database = $database;
			$this->query = "INSERT INTO $this->database $this->querystring $this->condition";
			if($this->mysqli->query($this->query)or die(mysqli_error($this->mysqli))){
				return $resultid = $this->mysqli->insert_id;
			}else{
				return "false";
			}
		}else{
			return "false";
		}
	}
	public function updateDatabase($database,$dataname,$datavalues,$condition){
		connection::connecter();
		$this->database = $database;
		$this->querystring = $this->setUpdateQueryString($dataname,$datavalues);
		$this->condition = $condition;
		if($this->querystring != "false"){
			$query = "UPDATE $this->database SET $this->querystring $this->condition";
			if($this->mysqli->query($query)or die(mysqli_error($this->mysqli))){
				return "true";
			}else{
				return "false";
			}
		}else{
			return "false";
		}
	}
	public function simpleSelect($database,$items,$condition){
		/**===================================================
		The first variable of this function is the table name.

		The second is the items to be selected, which can be * or an array of names or a single name. Note if the name is more than 1, and you are not selecting all data, then it must have to be an array.
		
		Then he third is the condition by which the selection is made. This condition should be written as the core sql, with no exception, if at all it will be needed
		=====================================================*/
		$this->database = $database;
		$this->items = $this->setItems($items);
		$this->condition = $condition;
		if($this->items != "false"){
			$query = "SELECT $this->items FROM $this->database $this->condition";
			if($this->dat = $this->mysqli->query($query)){
				$selected =array();
				/**==========================================================
					this will return the array sorted into a single array
				=========================================================*/
				while($this->data = $this->dat->fetch_array()){
					foreach ($items as $value) {
						$selected[]	= $this->data[$value];
					}
				}
				return $selected;
			}else{
				return "false";
			}
		}else{
			return "false";
		}		
	}
	public function innerjoinselect($database,$joindb,$items,$selecter,$condition){
		connection::connecter();
		$this->condition = $condition;
		$this->selecter = $selecter;
		$this->joindb = $joindb;
		$this->database = $database;
		$this->items = $this->setItems($items);
		$query = "SELECT $this->items FROM $this->database JOIN $this->joindb ON $this->condition";	
		if($this->dat = $this->mysqli->query($query)or die(mysqli_error($this->mysqli))){
			/**==========================================================
				this will return the array sorted into a single array
			=========================================================*/
			while($this->data = $this->dat->fetch_array()){
				foreach ($this->selecter as $value){
					$this->selected[]	= $this->data[$value];
				}
			}
			return $this->selected;
		}else{
			return "false";
		}
	}
	public function deleteFromDatabase($database,$column_name,$id){
		connection::connecter();
		$quer = "DELETE FROM $database WHERE $column_name = $id";
		if($this->mysqli->query($quer)){
			return "true";
		}else{
			return "false";
		}
	}
	public function deleteExpiredFromDatabase($database,$column_name,$value){
		connection::connecter();
		$quer = "DELETE FROM $database WHERE $column_name < $value";
		if($this->mysqli->query($quer)){
			return "true";
		}else{
			return "false";
		}
	}
	public function isExist($database,$item,$condition){
		connection::connecter();
		$query = "SELECT $item FROM $database $condition";
		if($this->data = $this->mysqli->query($query)){
			$count = $this->data->num_rows;
			if($count<=0){
				return "false";
			}else{
				return $count;
			}
		}
	}
	public function countDatabase($database){
		connection::connecter();
		$query = "SELECT count(id) as id FROM $database";
		if($this->data = $this->mysqli->query($query)){
			$data = $this->data->fetch_array();
			return $data['id'];
		}
	}
	public function simpleSearch($database,$columns,$items,$toget,$condition){
		$this->searchitems = $this->setSearchItems($columns,$items);
		if($this->searchitems !="false"){
			$this->toget = $toget;
			$this->database = $database;
			$this->condition = $condition;
			$query = "SELECT $this->toget FROM $this->database WHERE $this->searchitems $this->condition";
			if($this->dat = $this->mysqli->query($query)){
				$selected =array();
				/**==========================================================
					this will return the array sorted into a single array
				=========================================================*/
				while($this->data = $this->dat->fetch_array()){
						$selected[]	= $this->data[$this->toget];
				}
				return $selected;
			}else{
				return "false";
			}
		}else{
			return "false";
		}
	}
	public function simpleSearch2($database,$columns,$items,$toget,$condition){
		$this->searchitems = $this->setSearchItems($columns,$items);
		if($this->searchitems !="false"){
			$this->toget = $this->setItems($toget);
			$this->database = $database;
			$this->condition = $condition;
			$query = "SELECT $this->toget FROM $this->database WHERE $this->searchitems $this->condition";
			if($this->dat = $this->mysqli->query($query)){
				$selected =array();
				/**==========================================================
					this will return the array sorted into a single array
				=========================================================*/
				while($this->data = $this->dat->fetch_array()){
					foreach ($toget as $value){
						$selected[]	= $this->data[$value];
					}
				}
				return $selected;
			}else{
				return "false";
			}
		}else{
			return "false";
		}
	}
}
?>