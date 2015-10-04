<!doctype html>

<?php 
	include 'akses.php';
	$username = $_SESSION['user'];
?>

<html>

<head>
    <title>Am I Safe?</title>
    <link rel="shortcut icon" href="../src/koki_2.ico">
    <script src="../js/jquery.min.js"> </script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script src="../js/defaultpage.js"></script>
    <script src="../js/fungsi.js"></script>
    <link rel="stylesheet" href="../css/default-page.css" type="text/css">
    <link rel="stylesheet" href="session.css" type="text/css">
    <link rel="stylesheet" href="../css/fonts.css" type="text/css">
    <style>
    .no-js #loader{
            display : none;
        }

        .js #loader {
            display : block;
            position: absolute;
        /*    position lalalla*/

        }

        #preloader {
        /*    position lalala*/
            position : fixed;
            z-index : 9999;
            left: 40%;
            top: 40%;
            size:100%;
            background: url(../../testpweb3/src/preloader/128x128/Preloader_10.gif) center no-repeat #fff;
        }
    </style>
    
</head>

<body>

    <div id="preloader"></div>
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
        		<h2 style="text-align:center"> Timeline </h2>
        	</div>
        	<?php 
        		include 'proses.php';
        		$frame = new Frame();
        		
        		$datamap = $frame->timeline();
        		
        		foreach($datamap as $titik){

        			echo ' <div class="postingan">';
        			
        			if($titik['pictureid']==NULL || !$titik['pictureid']){
        				$src="../userdata/default.jpg";
        				echo "		<img class='pp' src='$src'>";
        			}
        			else{
        				$id = $titik['pictureid'];
        				echo "<img class='pp' src='viewimage.php?id=$id'>";
        			}
        			
        			echo " <input type='hidden' value= ".$titik['f_lat']." class='lat'>";
        			echo " <input type='hidden' value= ".$titik['f_long']." class='long'>";
        			echo " <input type='hidden' value= '".$titik['alamat']."' class='address'>";

		        	$waktu = time_since(strtotime($titik['f_time']));

		        	$titik['kategori'] = strtoupper($titik['kategori']);
		        	
		        	if( $titik['alamat']!=NULL || $titik['alamat']!="" || !$titik['alamat'] )
		        		echo "	<h2 class='alamat'> " . $titik['kategori'] . "   -  " . $waktu ." ( ".$titik['f_user']." ) <br> di ".$titik['alamat']."  </h2> ";
		        	else
		        		echo "	<h2 class='alamat'> " . $titik['kategori'] . "   -  " . $waktu ." ( ".$titik['f_user']." ) <br> di </h2> ";
		        	
		        	
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
        			
		        		echo '			</div>';
        		}
        		
        	?>
   		 </div> 
	</div>
</body>
    
</html>
