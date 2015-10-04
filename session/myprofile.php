<!doctype html>

<?php 
	include 'akses.php';
	$username = $_SESSION['user'];
	

	$user=new User();
	$array=$user->initiate($username);
	$array = $user->checkUsername($username);
	
?>

<html>

<head>
    <title><?php echo $array['Firstname']." ".$array['Lastname'];  ?> </title>
    <link rel="shortcut icon" href="../src/koki_2.ico">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/defaultpage.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <link rel="stylesheet" href="../css/default-page.css" type="text/css">
    <script src="../js/fungsi.js"></script>
    <link rel="stylesheet" href="session.css" type="text/css">
    <link rel="stylesheet" href="../css/fonts.css" type="text/css">
    <?php  include 'proses.php'; ?>
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
        		<h2 style="text-align:center"> Your Profile </h2>
        	</div>
        	
        	
	        <div id="boxes">
	        	<?php 
	        	
	        	
	        	if(!$array['PictureID']){
	        		$src="../userdata/default.jpg";
	        		echo "<img src='$src'>";
	        	}
	        	else{
	        		echo '<img src="viewimage.php?id='.$array['PictureID'].'">';
	        	}
	        	
	        	?>
	        	
	        	<h1> <?php echo $array['Firstname']." ".$array['Lastname'] ;?>  </h1>
	        	<h2> Frame update :  <?php echo $user->getUserFrames($username) ?> </h2>
        	</div>
        	
        	<?php 
        		
        		$frame = new Frame();
        		
        		$datamap = $frame->profile($username);
        		
        		if($datamap){
	        		foreach($datamap as $titik){
						$id=$titik['f_id'];
	        			echo '<div class="postingan">
							
							<a href="deleteframe.php?fid='.$id.' "><img class="delicon" src="../userdata/delicon.png" ></a>
    						<a href="editframe.php?fid='.$id.' "><img class="delicon" src="../userdata/edicon.png" ></a>';
	        			
	        			
	        			$pid = $frame->getimageid($username);
	        			if($pid==NULL){
	        				$src="../userdata/default.jpg";
	        				echo "	<img class='pp'src='$src'>";
	        			}
	        			else{
	        				echo '<img class="pp" src="viewimage.php?id='.$pid.'">';
	        			}
	        			

	        		echo " <input type='hidden' value= ".$titik['alamat']." class='address'>";

		        	$waktu = time_since(strtotime($titik['f_time']));

		        	$titik['kategori'] = strtoupper($titik['kategori']);
		        	
		        	if($titik['alamat']!=NULL || $titik['alamat']!="")
		        		echo "	<h2 class='alamat'> ".$titik['kategori']."   -  ". $waktu ." (". $username.") <br> di  ".$titik['alamat']."   </h2> ";
		        	else
		        		echo "	<h2 class='alamat'> ".$titik['kategori']."   -  ". $waktu  ." (". $username.")  <br> di    </h2> ";
		        	
		        
		        	echo " <div class='clearfix'></div> ";
		        	
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
                        echo '	</div>';
	        			echo '<div id="clearfix"></div>';
                        
	        		}
	        		
        		}
        		else {
        			echo '<div class="postingan">';
        			
        			    $pid = $frame->getimageid($username);
	        			if($pid==NULL){
	        				$src="../userdata/default.jpg";
	        				echo "<img class='pp' src='.$src.'>";
	        			}
	        			else{
	        				echo '<img class="pp" src="viewimage.php?id='.$pid.'">';
	        			}
        			
        			
        			echo "	<h2> No updates from you, yet.  </h2> ";
        			echo '</div>';
        		}
        		
        		
        	?>
   		 </div>
	</div>
</body>
    
</html>
