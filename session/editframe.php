<?php

	include 'akses.php';
	$fid=$_GET['fid'];
	$user = $_SESSION['user'];
	$map = new Frame();
	if($map->checkOwner($fid,$user)){
		$array = $map->checkNode($fid);
		if(!$array){
			echo '<script languange="javascript">
					alert("Node yang kamu minta tidak ada/ sudah dihapus");
					document.location="index.php"
					</script>';
		}
		else{
			if(isset($_POST['editmark'])){
				$map->editMarker($fid);
			}
		}
	}
	else 
	{
		echo '<script languange="javascript">
				alert("Kamu bukan owner frame ini. ACCESS DENIED");
				document.location="index.php"
				</script>';
	}
	
?>


<html>

<head>
    <title>Ubah Kejadian</title>
    <link rel="shortcut icon" href="../src/koki_2.ico">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/defaultpage.js"></script>
    <link rel="stylesheet" href="../css/default-page.css" type="text/css">
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
        		<h2 style="text-align:center"> Tambah Kejadian </h2>
        	</div>
        	<div class="main-body">
	        	
            
        <form id="form" enctype="multipart/form-data"  style="display:block" action="" method="post">
			  <?php 
		        			if($array['AttachmentID']){
		        				echo '<img src = "viewimage.php?id='.$array['AttachmentID'].'" >';
		        				
		        			}
		        ?>
		        
            <div id='name' class='outerDiv'>
                <label for="name">Latitude </label>
                <input type="number" step="any" id="latitude" value="<?php echo $array['F_Lat'];?>" name="latitude" readonly readonly  />
                <div class='message' id='nameDiv'> FIELD INI TIDAK BISA DIEDIT </div>
               </div> 
               
            <div class='clearfix'></div> 
            <div id='name' class='outerDiv'>
                <label for="name">Longitude </label>
                <input type="text" step="any" id="longitude" value="<?php echo $array['F_Long'];?>" name="longitude" readonly required  />
                <div class='message' id='nameDiv'> FIELD INI TIDAK BISA DIEDIT </div>
               </div> 
            
            <div class='clearfix'></div>   
             <div id='category' class='outerDiv'>
                <label for="name">Kategori</label>
                 <select name="category"  required>
                  <option value="Curanmor">Curanmor</option>
                  <option value="Kecelakaan">Kecelakaan</option>
                  <option value="Begal">Begal</option>
                  </select>
                <div class='message' id='nameDiv'>Kategori kejadian </div>
               </div>  
                
            <div class='clearfix'></div>   
            <div id='deskripsi' class='outerDiv'>
                <label for="name">Deskripsi</label>
                 <input type="textarea" value="<?php echo $array['Deskripsi'];?>" name="deskripsi" required>
                <div class='message' id='nameDiv'> Deskripsi singkat mengenai kejadian tersebut</div>
            </div>
            
                <div class='clearfix'></div>   
                <div id='submit' class='outerDiv'>
                    <input type="submit" name='editmark' value="Edit Frame"/>
                </div>
        </form> 

                
			</div>
                </div>
		</div>
</body>
</html>