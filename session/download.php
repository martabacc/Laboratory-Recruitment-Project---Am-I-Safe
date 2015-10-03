<?php

	include 'akses.php';
	
	$user = new User();
	
	$pid = $_REQUEST['id'];
	$balik="select * from images where id= '$pid'";
	$data = $user->getimage($balik);
	$name = $data['Name'];
	$content=$data['Data'];
	$type=$data['Type'];
	$size=$data['Size'];
	
	header("Content-type:  $type");
	header("Content-length: $size");
	header("Content-disposition: attachment; filename=$name"); 
	
	echo $content;
	exit();
?>