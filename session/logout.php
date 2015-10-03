<?php
    require 'akses.php';
    session_destroy();
    
	if(isset($_COOKIE['login'])){
		$log = new Log();
		$log->logoutcookie();
	}
    else echo '<script languange="javascript">
					       alert("Anda tidak login dengan cookie, kan?");
						   document.location="../index.php"
						   </script>';
    
 exit;
?>