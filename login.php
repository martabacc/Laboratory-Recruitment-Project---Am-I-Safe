<?php 
    
		include 'Loginclass.php';
	
		$logging = new Log();

		session_start();
		
		if(isset($_COOKIE['login'])){
			$logging->logincookie();
		}
		
		if(isset($_SESSION['user'])){
			header("Location: session/index.php");
		}
		
		if(isset($_POST['login'])){
			$logging->loginbasic();
		}
?>