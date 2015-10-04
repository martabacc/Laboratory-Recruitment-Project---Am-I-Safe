<!doctype html>

<?php 
	include 'akses.php';
	$username = $_SESSION['user'];
	
	$user = new User();
	$user->initiate($username);
	$array = $user->checkUsername($username);

?>



<html>

<head>
    <title><?php echo $array['Firstname']." ".$array['Lastname'];  ?></title>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/defaultpage.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="editprofile.css" type="text/css">
    <link rel="stylesheet" href="../css/default-page.css" type="text/css">
    <link rel="stylesheet" href="session.css" type="text/css">
    <link rel="stylesheet" href="addframe.css" type="text/css">
    <link rel="stylesheet" href="../css/fonts.css" type="text/css">
    
</head>

<body>

    
    <div class="coba" style="height: auto">
        <div id="left">
        <img src="../src/koki.png" id="icon">
        
            <div id="menu">
            <ul id="left-pane">
		                <li><a href="dashboard.php">Dashboard</a></li>
		                <li><a href="index.php">Timeline</a></li>
		                <li><a href="myprofile.php">My Profile</a></li>
		                <li><a href="editprofile.php">Edit Profile</a></li>
		                <li><a href="addframe.php">Add node</a></li>
		                <li><a href="maps.php">Check the maps</a></li>
		                <li><a href="logout.php">Logout</a></li>
            </ul>
            </div>
        
        </div>
        
        <div id="right">
        	<div id="header">
        		<h2> Edit Profile </h2>
        	</div>
        	<div class="main-body">
        		
			        	<form enctype="multipart/form-data" name="registrasi" action="" method="post">
                                    <div id='profpic'>
                                        <h3>Current Pict.</h3>
                                        <?php 
                                            if(!$array['PictureID'])
                                                echo	'<img src=  "../userdata/default.jpg" >';
                                            else
                                                echo '<img src = "viewimage.php?id='.$array['PictureID'].'" >';
                                
                                        ?>
                                    </div>
		                            
	                       	<p>
	                       		<label>Username : <input type="text" name="username" value="<?php echo $array['Username'];?>" disabled ></label>
	                        </p>
	                        <p>
	                        	<label>Nama Depan : <input type="text" name="fname" value="<?php echo $array['Firstname'];?>" required ></label>
	                        </p>
	                        <p>
	                        	<label>Nama Belakang : <input type="text" name="lname" value="<?php echo $array['Lastname'];?>"  required ></label>
	                        </p>
	                        <p>
	                        <label>Profile Picture :  <input type="file" name="photo" id="photo" ></label>
	                        </p>
	                        <p>
	                        	<label>New Password :  <input type="password" name="newpass" required ></label>
	                        </p>

	                        <div id="validation">
		                         <p>
		                        <label>Old-Password <input type="password" name="oldpass" required></label>
		                        </p>
	                        </div>
	                        
	                        <button type="submit" name="editprofil">Edit Profil</button>
	                        <?php 	if(isset($_POST['editprofil']))
										$user->editUser();
									?>
	
	                </form>
            </div>
        </div>
        
    </div>

</body>
    
</html>