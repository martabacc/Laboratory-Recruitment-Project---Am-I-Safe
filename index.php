
<?php include 'login.php';?>
<!DOCTYPE HTML >

<html>
    <head>
    <title>Am I Safe?</title>
    
    <link type="text/css" rel="stylesheet" href="css/index.css">
    <link type="text/css" rel="stylesheet" href="css/fonts.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    
    </head>
	
    <body>
    
        <div id="wrapper">
            <div id="login-box">
                <form name="lala" action="" method="post">
                    <fieldset>
                        <legend> Discover your society </legend>
                        <p> <label> Username  <input type="text" name="username" required autofocus> </label></p>
                        <p> <label> Password :  <input type="password" name="password" required></label></p>
                        <p> <label> Keep Logged In <input id="keep" type="checkbox" name="keeplogged"> </label>
                        	<input type="submit" name="login" value="LogIn"/>
                        
                        </p>
                        <p>Dont have an account? <a href="registrasi.php"> Register </a></p>
                    </fieldset> 
                    
                </form>
                <script>

                </script>
            </div>
        </div>
    
    </body>

</html>
