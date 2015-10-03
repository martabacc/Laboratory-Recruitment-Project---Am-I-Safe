

$(document).ready(function(){
    
	$('.postingan').click(function(){
		$(this).find('.bukti').slideToggle('medium');
	});
	
	$('.postingan').each(function()
    {
    	var header = $(this).find('.alamat');

    	var lat = $(this).find('.lat').val();
    	var long = $(this).find('.long').val();
    	var alamat = $(this).find('.address').val();
    	var counter = 1;
    	if( alamat.length == 0) 
    	{	
    		var latlong = new google.maps.LatLng(lat, long);
    		var geocoder = new google.maps.Geocoder();
    		geocoder.geocode({'latLng':latlong}, function(results, status){
	    		if( status== google.maps.GeocoderStatus.OK )
	    		{
	    			if( results[0] )
	    			{
	    				header.append( document.createTextNode( results[0].formatted_address) );
	    			}
	    		}
    			else 
	    		{
    				header.append( document.createTextNode('Koordinat : '+ latlong));
	    		}
	    		
	    	});
    	}
    });

});