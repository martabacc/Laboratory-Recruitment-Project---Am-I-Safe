<!doctype html>

<?php 
	include 'akses.php';
	$username = $_SESSION['user'];
?>

<html>

<head>
    <title>Am I Safe?</title>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/defaultpage.js"></script>
    <link rel="stylesheet" href="../css/default-page.css" type="text/css">
    <link rel="stylesheet" href="session.css" type="text/css">
    <link rel="stylesheet" href="../css/fonts.css" type="text/css">
    
</head>

<body>

    
    <div class="coba" style="height: auto">
        <div id="left">
        <img src="../src/koki.png" id="icon">
        
            <div id="menu">
            <ul id="left-pane">
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
        		<h2 style="text-align:center"> Timeline </h2>
        	</div>
        	<?php 
        		
        		$frame = new Frame();
        		
        		$datamap = $frame->timeline();
        		
        		foreach($datamap as $titik){

        			echo '<div class="postingan">';
        			
        			if($titik['pictureid']==NULL || !$titik['pictureid']){
        				$src="../userdata/default.jpg";
        				echo "		<img class='pp' src='$src'>";
        			}
        			else{
        				$id = $titik['pictureid'];
        				echo "<img class='pp' src='viewimage.php?id=$id'>";
        			}
        			
		        	
		        	echo "	<h2> ".$titik['kategori']." | ".$titik['f_time']."  | Koordinat: ".$titik['f_lat'].",  ".$titik['f_long']."  </h2> ";
		        	echo "	<p> Ditambahkan oleh ".$titik['f_user']." </p> ";
		        	
		        	$attachid=$titik['attachmentid'];
				        	echo "		<div class='bukti'> ";
				        	if($attachid){
				        		echo "      	<img class='descimg' src='viewimage.php?id=$attachid'>";
				        		echo "      	<p class='descwdimg'> ".$titik['deskripsi']."</p>";
				        		echo "			<a href='download.php?id=".$attachid."'>
	                        					<div class='linkdonlot'> Download bukti kejadian </div>
	                        					</a> ";
		        			}
		        			else
				        		echo "      	<p class='descnoimg'> ".$titik['deskripsi']."</p>";
			        		echo '			</div>';
		        		echo '			</div>';
        		}
        	?>
   		 </div>
	</div>
</body>
    
</html>
