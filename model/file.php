<?php
trait file{
	public function createDirectory($patharray){
		$this->patharray = $patharray;
		$this->dir = "";
		$this->count = sizeof($this->patharray);
		for($i = 0;$i<$this->count;$i++){
			$this->dir .= $this->patharray[$i]."/";
			if(!file_exists($this->dir)){
				mkdir($this->dir);
				continue;
			}else{
				continue;
			}
		}
		return $this->dir;
	}
	public function createUserDirectory($patharray){
		$this->patharray = $patharray;
		$this->dir = "../";
		$this->count = sizeof($this->patharray);
		for($i = 0;$i<$this->count;$i++){
			$this->dir .= $this->patharray[$i]."/";
			if(!file_exists($this->dir)){
				mkdir($this->dir);
				continue;
			}else{
				continue;
			}
		}
		return $this->dir;
	}
	public function uploadfile($filename,$filetemp,$path,$i){
		$this->filename=$filename;
		$this->dat = date('YmjHis');
		$this->newname = $this->dat."_".$i;
		$this->filename = substr_replace($this->filename, $this->newname,0 ,-4);
		$this->filetemp = $filetemp;
		$this->path = $path;
		connection::connecter();
		if(!file_exists($this->path)){
			mkdir($this->path);
			$this->uploadResult =move_uploaded_file($this->filetemp,$this->path.$this->filename);

			return $this->path.$this->filename;
		}else{
			$this->uploadResult =move_uploaded_file($this->filetemp,$this->path.$this->filename);
			return $this->path.$this->filename;
		}
	}
	public function uploadthumbnail($path,$i){
		$this->dat = date('YmjHis');
		$this->newname = $this->dat."_".$i;
		$this->filename = substr_replace($path, $this->newname,0 ,-4);
		$this->path = $path;
		$this->target = dirname($this->path)."/".$this->filename;

		connection::connecter();
		$im = new Imagick($this->path,"[0]");
		$im->setImageColorspace(255);
		$im->setimageformat("jpeg");
		$im->thumbnailimage(160,120);
		$im->writeimage($this->target);
		$im->clear();
		$im->destroy();
		return $this->target;
	}
	public function downloader($filename){
		$filedata = @file_get_contents($filename);

		//SUCCESS
		if($filedata){
			//GET A NAME FOR THE FILE
			$basename = basename($filename);
			//THESE HEADERS ARE USED ON ALL BROWSERS
			header("Content-Type: application-x/force-download");
			header("Content-Disposition: attachment; filename=$basename");
			header("Content-length: ".(string)(strlen($filedata)));
			header("Expires: ".gmdate("D, d M Y H:i:s", mktime(date("H")+2, date("i"), date("s"), date("m"), date("d"), date("Y") ) )." GMT");
			header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
			//THIS HEADER MUST BE OMITTED FOR IE 16+
			if(FALSE === strpos($_SERVER["HTTP_USER_AGENT"], "MSIE")){
				header("Cache-Control: no-cache, must-revalidate");
			}
			//THIS IS THE LAST HEADER
			header("Pragma: no-cache");
			flush();
			ob_start();
		}else{
			die("ERROR! Unable to Download file");
		}
	}
	public function unlinker($address_string){
		$newval = explode("#",$address_string);
		foreach ($newval as $val){
			unlink($val);
		}
	}
}
?>