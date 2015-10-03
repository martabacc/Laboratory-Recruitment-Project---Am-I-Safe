$(document).ready(function(){

    
    $('#left').hover(
     function(){
    	$(this).stop(true);
        $('#menu').slideToggle('medium');
    },
    	function(){
    	$(this).stop(true);
        $('#menu').slideToggle('medium');
    });

});