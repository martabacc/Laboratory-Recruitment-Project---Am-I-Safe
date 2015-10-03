/**
 * 
 */

$(document).ready(function(){
	
	function geocoderlala(){
		var y = document.getElementById("latitude");
		var z = document.getElementById("longitude");
		
		var geocoding = new google.maps.Geocoder();
		
		var div = document.getElementById("alamat");
		
		geocoding.geocode({"address":div.value},function(results,status){
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
		
					y.value = results[0].geometry.location[lat];
					z.value = results[0].geometry.location[lng];
					div.value = results[0].formatted_address;
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
});