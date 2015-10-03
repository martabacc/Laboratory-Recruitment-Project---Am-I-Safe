	<?php 

			$load = "'load'";
			$click = "'click'";
			echo '<script languange="javascript">
				
				var centerpoint = new google.maps.LatLng(-7.2756195,112.7116844,12);
					
				function initMap () {
					//Enabling new cartography and themes
					google.maps.visualRefresh = true;
					
					var mapOptions = {
						center: centerpoint,
						zoom: 13,
						mapTypeId: google.maps.MapTypeId.ROADMAP};
					
					map = new google.maps.Map(document.getElementById("mapDiv"), mapOptions);
					
						if(navigator.geolocation){
						navigator.geolocation.getCurrentPosition(function(position){
						centerpoint = new google.maps.LatLng(position.coords.latitude,
															 position.coords.longitude);
						
						var markme = new google.maps.Marker({
											map : map,
											position: centerpoint,
											animation : google.maps.Animation.BOUNCE});	
											map.setCenter(centerpoint);
											map.setZoom(16);
						});
						
						}
				
					
					
					var places = [';
				
						include 'akses.php';
						$map = new Frame();
						
						$getMark = $map->forMaps();
						
						
						foreach ( $getMark as $row) 
						{   echo "{
							id:'". $row['F_ID']."',
							lat:". $row['F_Lat'].",
							long:". $row['F_Long'].",
							user:'". $row['F_User']."',
							kategori:'". $row['Kategori']."',
							waktu:'". $row['F_Time']."'
							},";
						}
						
					echo "{}]
							
						
						  for(var i = 0 ; i < places.length-1; i++){
								addPlace(places[i]);
						  }
						   
						   
						   function addPlace(place){
									var marker= new google.maps.Marker({ 
												position: new google.maps.LatLng(place.lat,place.long),
												map: map });
									var information = '<div >'+
														'<p> Kategori : '+ place.kategori +' <p><br>'+
														'<p> Waktu : '+ place.waktu +' </p><br>'+
														'<p> Ditambahkan oleh ' + place.user + ' </p><br>'+
														'</div>';	
									var infowindow = new google.maps.InfoWindow({
													 content: information		
													 });
									google.maps.event.addListener(marker, 'click', function() {
													    infowindow.open(map,marker);
													  });
						   }";	   
							
				echo '}';
						
				//and finally
				echo ' google.maps.event.addDomListener(window, '.$load.', initMap); </script>';
?>
