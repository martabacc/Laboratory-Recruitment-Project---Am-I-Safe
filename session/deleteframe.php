<?php

	include 'akses.php';
	$frame=$_GET['fid'];
	$map = new Frame();
	$user = $_SESSION['user'];
	$map->delf($frame,$user);
	
?>