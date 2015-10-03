<!doctype html>
<?php 
	include 'akses.php';
	$username = $_SESSION['user'];
	
	$map = new Frame();
	
	if(isset($_POST['addmark']))
		$map->addMarker($username);
?>

<html>

<head>
    <title> Am I Safe? </title>
    <script  type="text/javascript" src="../js/jquery.min.js"></script>
  	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script  type="text/javascript" src="../js/defaultpage.js"></script>
    <link rel="stylesheet" href="../css/default-page.css" type="text/css">
    <link rel="stylesheet" href="addframe.css" type="text/css">
    <link rel="stylesheet" href="../css/fonts.css" type="text/css">
    <link rel="stylesheet" href="maps.css" type="text/css">
    <?php include'addframe_map.php';?>
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
        		<h2 style="text-align:center"> Tambah Kejadian </h2>
        	</div>
        	<div class="main-body">
	        	
		 
            <p id="notification">
            </p>
        
        <div id='mapDiv'></div>
        <div id="form">        
            
        <form id="registrasi" enctype="multipart/form-data"  style="display:block" action="" method="post">

                <input type="hidden"  id="latitude" name="latitude" required  />
                <input type="hidden"  id="longitude" name="longitude"  required  />
            

            <div class='clearfix'></div> 
            <div id='cekalamat' class='outerDiv'>
            	<label for="name">Alamat</label>
                <input type="text" id="alamat" name="alamat" required autofocus />
                <p>Apa alamat tersebut benar? Jika tidak, masukkan alamat anda lalu klik </p>  <button id="click" onclick="geocoderlala()">Cari Alamat</button>
			 </div>
			
            <div class='clearfix'></div> 
              
             <div id='category' class='outerDiv'>
                <label for="name">Kategori</label>
                 <select name="category" required>
                  <option value="Curanmor">Curanmor</option>
                  <option value="Kecelakaan">Kecelakaan</option>
                  <option value="Begal">Begal</option>
                  </select>
                <div class='message' id='nameDiv'>Kategori kejadian </div>
               </div>  
                
            <div class='clearfix'></div>   
            <div id='deskripsi' class='outerDiv'>
                <label for="name">Deskripsi</label>
                 <input type="textarea" name="deskripsi" required/>
                <div class='message' id='nameDiv'> Deskripsi singkat mengenai kejadian tersebut</div>
            </div>  
            
            <div class='clearfix'></div>   
            
             <div id='deskripsi' class='outerDiv'>
                <label for="name"> Attachment </label>
                 <input type='file' name='attachment' id='attachment'>
                <div class='message' id='nameDiv'>Saat ini hanya berupa gambar</div>
            </div> 
             
            <div class='clearfix'></div>   
            
             <div id='deskripsi' class='outerDiv'>
                <label for="name"> Password </label>
                 <input type="password" name="password"  required>
                <div class='message' id='nameDiv'>INGAT : DATA PALSU MAKA ACCOUNT ANDA DIBANNED</div>
            </div> 
                <div class='clearfix'></div>   
           	
           	<div id='submit' class='outerDiv'>
                    <input type="submit" name='addmark' value="Create Frame"/>
            </div>
            <div class='clearfix'></div>   
        </form> 

            </div>
                
			</div>
                </div>
		</div>
	</div>
</body>
</html>