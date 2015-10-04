	<?php 

			$load = "'load'";
			$click = "'click'";
			echo '<script languange="javascript">
				
				var centerpoint = new google.maps.LatLng(-7.2756195,112.7116844,12);
				var geocoder;
				var map;	
				function initMap () 
                {
					var x = document.getElementById("notification");
          			var y = document.getElementById("latitude");
            		var z = document.getElementById("longitude");
					google.maps.visualRefresh = true;
					
					var mapOptions = {
						center: centerpoint,
						zoom: 15,
						mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
					
					map = new google.maps.Map(document.getElementById("mapDiv"), mapOptions);
					
					if(navigator.geolocation)
					{
						navigator.geolocation.getCurrentPosition(function(position){
								centerpoint = new google.maps.LatLng(position.coords.latitude,
																	 position.coords.longitude);
								
								
								y.value = position.coords.latitude;
								z.value = position.coords.longitude;
								var geocoder = new google.maps.Geocoder();
					
								geocoder.geocode({"latLng":centerpoint}, function(results, status){
						        	//alert("lalalla");
						    		if(status == google.maps.GeocoderStatus.OK){
						    			if(results[0])
						    			{
						    				x.innerHTML =  results[0].formatted_address ;
						    			}
						    		}
						    		else {
						    			x.innerHTML = "Alamat tidak bisa dideteksi - Koordinat : " +  centerpoint ;
						    		}
						    	});	
						
								var markme = new google.maps.Marker({
									map : map,
									position: centerpoint,
									animation : google.maps.Animation.BOUNCE
								});	
					
								var radar = new google.maps.Circle({
									map : map,
									center : centerpoint,
									radius : 1000 // 1 kilometer
								});
					
								map.setCenter(centerpoint);
								map.setZoom(15);
						});
					
						
					}
					else 
					{
               			 x.innerHTML = "Maaf, fitur ini hanya bisa diakses di oleh device yang support Geolocation";
               			 document.getElementById("cover").style.display="none";
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
														'<p> Kategori : '+ place.kategori +'<br>'+
														' Waktu : '+ place.waktu +' <br>'+
														' Ditambahkan oleh ' + place.user + ' </p>'+
														'</div>';	
									var infowindow = new google.maps.InfoWindow({
													 content: information		
													 });
									google.maps.event.addListener(marker, 'click', function() {
													    infowindow.open(map,marker);
													  });
						   }
							
							
							
							";	   
							
				echo '}'; //end of function initialize
						
				//and finally
				echo ' google.maps.event.addDomListener(window, '.$load.', initMap); </script>';
?>
