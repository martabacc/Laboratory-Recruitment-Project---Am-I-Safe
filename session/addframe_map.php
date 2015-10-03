	<?php 

			$load = "'load'";
			$click = "'click'";
			echo '<script languange="javascript">
				
					
				var centerpoint = new google.maps.LatLng(-7.2756195,112.7116844,12);
				var map;
				var markme;
					
				function initMap () {
					
          			var y = document.getElementById("latitude");
            		var z = document.getElementById("longitude");
            		var alamat = document.getElementById("alamat");
					
					var mapOptions = {
						center: centerpoint,
						zoom: 15,
						mapTypeId: google.maps.MapTypeId.ROADMAP};
					
					map = new google.maps.Map(document.getElementById("mapDiv"), mapOptions);
					var geocoder = new google.maps.Geocoder();
					
					
					if(navigator.geolocation)
					{	navigator.geolocation.getCurrentPosition(function(position){
								centerpoint = new google.maps.LatLng(position.coords.latitude,
																	 position.coords.longitude);
								
								
								y.value = position.coords.latitude;
								z.value = position.coords.longitude;
					
								geocoder.geocode({"latLng":centerpoint}, function(results, status){
						        	//alert("lalalla");
						    		if(status == google.maps.GeocoderStatus.OK){
						    			if(results[0])
						    			{
						    				alamat.value =  results[0].formatted_address ;
						    			}
						    		}
						    		else {
						    			alamat.value = "Alamat tidak bisa dideteksi - Koordinat : " +  centerpoint ;
						    		}
						    	});	
						
								var markme = new google.maps.Marker({
									map : map,
									position: centerpoint,
									animation : google.maps.Animation.BOUNCE,
									draggable: true
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
				
					
					   
							
				}

				function geocoderlala(){
					
					var geocoding = new google.maps.Geocoder();
					
					var div = document.getElementById("alamat");
					var al = div.value;
					
					geocoding.geocode({"address":al},function(results,status){
						alert("geocoding");
					
						if(status == google.maps.GeocoderStatus.OK){
							if(results[0])
						    {
						    		centerpoint = results[0].geometry.location;
									map.setCenter(results[0].geometry.location);
										
									var markme = new google.maps.Marker({
									map : map,
									position: centerpoint,
									animation : google.maps.Animation.BOUNCE,
								});	
					         //   console.log(results[0].geometry.location[lat]);
                             console.log(toString(results[0].geometry.location));
//								
								//ubah(results[0].formatted_address);
//                                console.log(div.value);
						    }
							
							
						}
                        
                        
						else if(status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT){
							alert("Query Limit Detected");
						}
						else if(status == google.maps.GeocoderStatus.REQUEST_DENIED){
							alert("Request Denied");
						}
						else if(status == google.maps.GeocoderStatus.ZERO_RESULTS)
						{
							alert("Maaf lokasi tidak dapat ditemukan, mungkin alamat yang anda masukkan tidak valid");
						}
						else
						{
							alert("Maaf alamat tersebut tidak dapat ditemukan");
						}
					});
				}
				
                function ubah(teks,lat,lng)
                        {
          			          document.getElementById("latitude").value = lat;
          			          document.getElementById("longitude").value = lng;
                              document.getElementById("alamat").value=teks;
                        }
						';
				echo ' google.maps.event.addDomListener(window, '.$load.', initMap);
					   
						
						</script>';
?>
