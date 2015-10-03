<!  DOCTYPE HTML >

<html>
    

    <head>
    
        
    <link type="text/css" rel="stylesheet" href="css/index.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    </head>
	
    </head>

    <body>
        <div class="header"></div>
        
        <div class="main">
            <div class="big-box">
                <form enctype="multipart/form-data" name="registrasi" action="" method="post">
                    <fieldset>
                        <h1> Registration </h1>
                        <p>
                        	<label> Nama Depan : <input type="text" name="fname"  required autofocus></label>
                        </p>
                        <p>
                        <label> Nama Belakang : <input type="text" name="lname"  required autofocus></label>
                        </p>
                        <p>
                        <label> Username : <input type="text" name="username"  required autofocus></label>
                        </p>
                        <p>
                        <label> Password :  <input type="password" name="pass" required></label>
                        </p>
                        <p>
                        <label> Profile Picture :  <input type="file" name="photo" id="photo" ></label>
                        </p>
                        <button type="submit" name="regist">Register</button>

                    </fieldset>
                </form>
            </div>
        </div>
    
    </body>


</html>
<?php 
	include 'Loginclass.php';
	
	$user = new User();
	if(isset($_POST['regist']))
		$user->createUser();
		
?>