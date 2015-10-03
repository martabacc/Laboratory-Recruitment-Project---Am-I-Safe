<?php	
	
	include '../Loginclass.php';

	date_default_timezone_set('Asia/Jakarta');
	if(!isset($_SESSION))
		session_start();
	
	if(!isset($_SESSION['user']))
	{
		echo '<script language="javascript">
				alert("Anda harus Login!"); 
				document.location="../index.php";
				</script>';
	}
	
?>