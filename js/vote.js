function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}

$(document).ready(function() {
	$('.save').click(function(){
		var vote_bt = $(".save").val();
		var id_poll = $("#id_poll").val();
		var option = $('input[type="radio"]:checked').val();
		if(!option){
			alert("Please choose one answer");
			return false;
		}
		var dataString = 'vote_bt=' + vote_bt + "&id_poll=" + id_poll + "&option=" + option;
		//alert(vote_bt);
		$.ajax({
			type: "POST",
			url: "db/vote.php",
			cache: false,
			data: dataString,
			dataType: "json",
			beforeSend: function(){ $(".save").val('Voting...');},
			success: function(data){
						
				if(data){
				
					$.ajax({
						type: "GET",
						url: "db/get_statistics.php?id_poll=" + id_poll,
						cache: false,
						dataType: "json",
						success: function(data){
							
							var votes = data.split("<br>");
							var text_div = "<div id = 'poll_modal_title'><h2>Statistics</h2></div><div>";
							
							for(i = 0; i < votes.length - 1; i++){
								var poll_answer = votes[i].split("|")[0];
								var vote = votes[i].split("|")[1];
								var num_votes = votes[i].split("|")[2];
								text_div = text_div + "<div id = 'poll_modal_title'><h3>" + poll_answer + " ( " + vote +  "% | " + num_votes + " votes )" + "</h3></div>";
								text_div = text_div + "<div style = 'width:" + 2*vote + "px; height: 20px; background-color:rgba(25, 53, 98, 1)'></div>";
							}
							
							text_div = text_div + "</div>";
							
							$('.poll_modal').html(text_div);
							$('.poll_modal').css("display", "none");
							$('.poll_modal').fadeIn("slow");
						},
						error: function(){
							alert("Error");
						}
					
					});		
				}
				else{
					alert("An error ocurred when saving your vote. Please try again.");
				}
				
			}
		});
		return false;
	});
	
	$('.statistics').click(function(){
		var id_poll = $("#id_poll").val();
				
		$.ajax({
			type: "GET",
			url: "db/get_statistics.php?id_poll=" + id_poll,
			cache: false,
			dataType: "json",
			success: function(data){

				var votes = data.split("<br>");
				var text_div = "<div id = 'poll_modal_title'><h2>Statistics</h2></div><div>";
				
				
				for(i = 0; i < votes.length - 1; i++){
					var poll_answer = votes[i].split("|")[0];
					var vote = votes[i].split("|")[1];
					var num_votes = votes[i].split("|")[2];
					text_div = text_div + "<div id = 'poll_modal_title'><h3>" + poll_answer + " ( " + vote +  "% | " + num_votes + " votes )" + "</h3></div>";
					text_div = text_div + "<div style = 'width:" + 2*vote + "px; height: 20px; background-color:rgba(25, 53, 98, 1)'></div>";
				}
							
				text_div = text_div + "</div>";
						
				$('.poll_modal').html(text_div);
				$('.poll_modal').css("display", "none");
				$('.poll_modal').fadeIn("slow");
			},
			error: function(){
				alert("Error");
			}
		
		});
		return false;
	});
	
});