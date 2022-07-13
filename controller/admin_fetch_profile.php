<?php
	$fetch = new register;
	$results = $fetch->adminPreviewProfile();
			//$this->items = array("id","name","email","chamber_name","imagepath","description","date");
	$staffname = $results[1];
	$email = $results[2];
	$name = $results[3];
	$imagepath = $fetch->formatUrl($results[4]);
	$profile = $results[5];
	$date = $results[6];
?>