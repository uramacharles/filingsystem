<?php 
trait format{
	/**==========================================================
		for pagination
	=============================================================**/
	/**==========================================================
		for Conditional Pagination
	=============================================================**/
	public function getConditionedPageVariables($dbase,$condition){
		$this->tablename = $dbase;
		$this->condition = $condition;
		connection::connecter();
		$this->w = "SELECT COUNT(id) FROM $this->tablename $this->condition ";
		$this->w1 = $this->mysqli->query($this->w);
		$this->row = $this->w1->fetch_row();
		$this->rows = $this->row[0];
		$this->page_rows = 10;
		$this->last = ceil($this->rows/$this->page_rows);
		if($this->last <1){
			$this->last = 1;
		}
		$this->pagenum = 1;
		if(isset($_GET['pn'])){
			$this->pagenum = preg_replace('#[^0-9]#','',$_GET['pn']);
		}
		if($this->pagenum <1){
			$this->pagenum = 1;
		}else if($this->pagenum > $this->last){
			$this->pagenum = $this->last;
		}
		$this->paginationCtrls = "";
		if($this->last != 1){
			if($this->pagenum >1){
				$this->previous = $this->pagenum - 1;
				$this->paginationCtrls .= '<a href = "'.$_SERVER['PHP_SELF'].'?pn='.$this->previous.'" class="btn btn-style-one" >previous</a>';
			}
			if($this->pagenum != $this->last){
				$this->next = $this->pagenum+1;
				$this->paginationCtrls .='  <a href="'.$_SERVER['PHP_SELF'].'?pn='.$this->next.'" class="btn btn-style-two">Next</a>';
			}
		}
		$_SESSION['from'] = ($this->pagenum-1)*$this->page_rows;
		$_SESSION['page_rows'] = $this->page_rows;
		return $this->paginationCtrls;
	}
	/**==========================================================
		URL Formatting
	=============================================================**/
	public function formatUrl($url){
		$this->url = str_replace("../", "", $url);
		return $this->url;
	}
}
?>