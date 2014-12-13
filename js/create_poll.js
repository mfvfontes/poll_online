
function validateTitle(){

	var title_validated = false;
	
	for(i = 0; i <= 10; i++){
	
		if(!title_validated){
			
			if( typeof $('input[name="title"]')[i] !== "undefined" ){
			
				if( $('input[name="title"]')[i].value != "")
					return true; //RETURN POSITION
				
			}
			
		}
	
	}
	
	return false; //NOT VALIDATED

}

function validateQuestion(){

	var question_validated = false;
	
	for(i = 0; i <= 10; i++){
	
		if(!question_validated){
			
			if( typeof $('input[name="question"]')[i] !== "undefined" ){
			
				if( $('input[name="question"]')[i].value != "")
					return true; //RETURN POSITION
			}
		}
	
	}
	
	return false; //NOT VALIDATED
}

function validateAnswers(){

	var txt_answer_last = $(".txt_answer").last()[0].name;
	
	var pos = strrpos(txt_answer_last, '_');
		
	//var first_part = "answer_";
	var second_part_last = txt_answer_last.substr(pos+1);
	
	//var second_part = (parseInt(second_part_last)+1).toString();
	
	var last_answer = parseInt(second_part_last);
	
	
	for(i = 1; i <= last_answer; i++){
		
		answer_name = "answer_" + i.toString();
		
		var has_one_active = false;
		
		var all_blank = true;
		
		for(j = 0; j < 100; j++){
			
			if(!has_one_active){
			
				if( typeof $('input[name="' + answer_name + '"]')[j] !== "undefined" ){

					if( $('input[name="' + answer_name + '"]')[j].value != "REMOVED"){
						
						has_one_active = true;
						
						if( $('input[name="' + answer_name + '"]')[j].value != "" )
							all_blank = false;
				
					}
				}
			} else{
				if( typeof $('input[name="' + answer_name + '"]')[j] !== "undefined" ){
			
					if( $('input[name="' + answer_name + '"]')[j].value != "REMOVED"){
									
						if( $('input[name="' + answer_name + '"]')[j].value != "" )
							all_blank = false;
				
					}
					
				}
			}
		
		}
		
		if(has_one_active){
			if(all_blank){
				alert("Some answers are empty. Please fill the answer(s) with some info or remove it(them).");
				return false;
			}
		}
			
	}
	
	return true;

}

function getTitle(){
	var title_validated = false;
	
	for(i = 0; i <= 10; i++){
	
		if(!title_validated){
			
			if( $('input[name="title"]')[i].value != "")
				return $('input[name="title"]')[i].value; //RETURN VALUE
			
		}
	
	}
}

function getQuestion(){
	var question_validated = false;
	
	for(i = 0; i <= 10; i++){
	
		if(!question_validated){
			
			if( $('input[name="question"]')[i].value != "")
				return $('input[name="question"]')[i].value; //RETURN VALUE
			
		}
	
	}
}

function getPublic(){
	var public_validated = false;
	
	for(i = 0; i <= 10; i++){
	
		if(!public_validated){
			if( typeof $('input[name="public"]')[i] !== "undefined" ){
				if( $('input[name="public"]')[i].checked != false)
					return "on"; //RETURN VALUE
			}
		}
	
	}
	
	return "off";
}

function getAnswers(){
	
	var txt_answer_last = $(".txt_answer").last()[0].name;
	
	var pos = strrpos(txt_answer_last, '_');
		
	//var first_part = "answer_";
	var second_part_last = txt_answer_last.substr(pos+1);
	
	//var second_part = (parseInt(second_part_last)+1).toString();
	
	var last_answer = parseInt(second_part_last);
	
	
	for(i = 1; i <= last_answer; i++){
		
		answer_name = "answer_" + i.toString();
		
		var has_one_active = false;
		
		var all_blank = true;
		
		for(j = 0; j < 100; j++){
			
			if(!has_one_active){
			
				if( typeof $('input[name="' + answer_name + '"]')[j] !== "undefined" ){

					if( $('input[name="' + answer_name + '"]')[j].value != "REMOVED"){
						
						has_one_active = true;
						
						if( $('input[name="' + answer_name + '"]')[j].value != "" )
							all_blank = false;
				
					}
				}
			} else{
				if( typeof $('input[name="' + answer_name + '"]')[j] !== "undefined" ){
			
					if( $('input[name="' + answer_name + '"]')[j].value != "REMOVED"){
									
						if( $('input[name="' + answer_name + '"]')[j].value != "" )
							all_blank = false;
				
					}
					
				}
			}
		
		}
		
		if(has_one_active){
			if(all_blank){
				alert("Some answers are empty. Please fill the answer(s) with some info or remove it(them).");
				return false;
			}
		}
			
	}
	
	return true;
	
}

function validateForm(){

	if( !validateTitle() ){
		alert("Please choose a title");
		return false;
	}
	else if( !validateQuestion() ){
		alert("Please choose a question");
		return false;
	}
	else if( !validateAnswers() ){
		return false;
	}
	else
		return true;
}

$(document).ready(function (){
	$('.save').click(function(){

		if( !validateForm() )
			return false;
		
		var title = getTitle();
		var question = getQuestion();
		var public_poll = getPublic();
		
		var txt_answer_last = $(".txt_answer").last()[0].name;
	
		var pos = strrpos(txt_answer_last, '_');
	
		var second_part_last = txt_answer_last.substr(pos+1);
	
		var last_answer = parseInt(second_part_last);
		
		//var form = $('.poll_modal_form')[0];
		var formData = new FormData();
		
		formData.append('title', title);
		formData.append('question', question);
		
		if(public_poll == "on")
			formData.append('public', public_poll);
		
		for(i = 1; i <= last_answer; i++){
			
			answer_name = "answer_" + i.toString();
			
			var has_one_active = false;
					
			for(j = 0; j < 100; j++){
				
				if(!has_one_active){
				
					if( typeof $('input[name="' + answer_name + '"]')[j] !== "undefined" ){

						if( $('input[name="' + answer_name + '"]')[j].value != "REMOVED"){
							
							if( $('input[name="' + answer_name + '"]')[j].value != "" ){
								formData.append(answer_name, $('input[name="' + answer_name + '"]')[j].value);
								break;
							}
					
						}
					}
				} 
			}	
		}
			
		formData.append('file', $("#imagefile")[0].files[0]);
		formData.append('total_answers', last_answer);
		
		$.ajax({
			type: "POST",
			url: "db/create_poll.php",
			cache: false,
			processData: false,
			contentType: false,
			data: formData,
			dataType: "json",
			beforeSend: function(){ $(".save").val('Saving...');},
			success: function(data){
						
				if(data){
					window.location.reload();
				}
				else{
					alert("An error ocurred when saving your poll. Please try again.");
				}
				
			},
			error: function(){
				alert("Error");
			}
		});
		return false;
	});
});