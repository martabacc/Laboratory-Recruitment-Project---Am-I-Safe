<?php

	include 'akses.php';
	
	$user = new User();
	
	$pid = $_REQUEST['id'];
	$balik="select * from images where id= '$pid'";
	$data = $user->getimage($balik);
	$content=$data['Data'];
	$type=$data['Type'];
	//$size=$data['Size'];
	
	header("Content-type: $type");
	//header("Content-type: $size");
	
	echo $content;
?>