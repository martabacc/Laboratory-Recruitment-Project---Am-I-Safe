
<!DOCTYPE html>
<html>
    <head>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script src="../js/jquery.min.js" ></script>
    <script src="../js/defaultpage.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#setuju').click(function(){
                alert("lalala");
                var latitude = $('#latitude').val();
                var longitude = $('#longitude').val();
                 $('#tambahkan').load("load.php","lat="+latitude+"&lng="+longitude,beritahu());
                        
                
            });
            
            function beritahu(){
                alert("lalalallala");
            }
        });    
    </script>
    <link rel="stylesheet" href="editprofile.css" type="text/css">
    <link rel="stylesheet" href="../css/default-page.css" type="text/css">
    <link rel="stylesheet" href="session.css" type="text/css">
    <link rel="stylesheet" href="../css/fonts.css" type="text/css">
    <link rel="stylesheet" href="maps.css" type="text/css">
   <?php 
   	include 'peta-coba-2.php';
	?>
	
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
        		<h2 style="text-align:center"> Nearby </h2>
        	</div>
        	
			
			<div id="mapDiv"></div>
                    <input type="text" id="latitude">
                    <input type="text" id="longitude">
                    <input type="submit" name='setuju' id='setuju' value="RENDER ME"/>
                
  			    <p id="notification"></p>

                <div id='tambahkan'></div>
   		 </div> 
	</div>

	</body>
	
</html>