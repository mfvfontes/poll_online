
  $(function() {
	var polls = polls_response.responseJSON.split("<br>");
    $( "#tags" ).autocomplete({
      source: function(request, response) {
        var results = $.ui.autocomplete.filter(polls, request.term);

        response(results.slice(0, 10));
		
    },
	  select: function (e, ui) {
		
		inner_html = $.ajax({
					type: "GET",
					url: "db/poll.php?title=" + $(ui)[0].item.value,
					cache: false,
					async: false,
					dataType: "json",
					success: function(data){		
						
					}
				});
		loadScript("js/jquery.avgrund.js");
		loadScript("js/vote.js");
    }
    });
  });