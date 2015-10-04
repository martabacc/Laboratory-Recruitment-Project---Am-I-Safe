
<!DOCTYPE html>
<html>
    <head>
    <title>Dashboard</title>
    <link rel="shortcut icon" href="../src/koki_2.ico">
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script src="../js/jquery.min.js" ></script>
    <script src="../js/defaultpage.js"></script>
    <script type="text/javascript">
    
        $(document).ready(function(){
            $('#setuju').click(function(){
                var latitude = $('#latitude').val();
                var longitude = $('#longitude').val();

                $.ajax({
                	  method: "POST",
                	  url: "load.php",
                	  data: { lat: latitude, lng: longitude },
          	  		  beforeSend : function( xhr ){
              	  			$('#preloader').show();
              	  		}
                	}).done(function( msg ) {
                    	
                	    $('#tambahkan').html(msg);
                	    beritahu();
                	  });
                
               // $('#tambahkan').load("load.php","lat="+latitude+"&lng="+longitude,beritahu());
                        
            });
            
            function beritahu()
            {
  	  			$('#preloader').hide();
                $('#setuju').fadeOut('slow');
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
    
	<div id="preloader" style="height:100%; width:100%; visibility:hidden;">
			<img src="../src/rotatingearth.gif"/>
		</div>
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
			
                <input type="hidden" id="latitude"/>
                <input type="hidden" id="longitude"/>
                <input type="submit" id="setuju" value=" Render Me! "/> 
                
  			    	<h3> Anda berada di : </h3>
  			    	<p id="notification"></p>

                <div id='tambahkan'></div>
   		 </div> 
	</div>

	</body>
	
</html>