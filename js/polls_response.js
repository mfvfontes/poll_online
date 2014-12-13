var polls_response;

$(function() {
	polls_response = $.ajax({
		type: "GET",
		url: "db/poll.php?all=true" ,
		cache: false,
		async: false,
		dataType: "json",
		success: function(data){
				
			if(data){
				//TODO
			}
				
					
		}
			
	});
	loadScript("js/available_tags.js");
});
