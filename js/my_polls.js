var polls_response;

function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 

function validateEmails(){

	var txt_email_last = $(".txt_email").last()[0].name;
	
	var pos = strrpos(txt_email_last, '_');
		
	var second_part_last = txt_email_last.substr(pos+1);
	
	var last_email = parseInt(second_part_last);
	
	
	for(i = 1; i <= last_email; i++){
		
		email_name = "email_" + i.toString();
		
		var has_one_active = false;
		
		var all_blank = true;
		
		var validated_email = false;
		
		for(j = 0; j < 100; j++){
			
			if(!has_one_active){
			
				if( typeof $('input[name="' + email_name + '"]')[j] !== "undefined" ){

					if( $('input[name="' + email_name + '"]')[j].value != "REMOVED"){
						
						has_one_active = true;
						
						if( $('input[name="' + email_name + '"]')[j].value != "" ){
							all_blank = false;
							if(validateEmail($('input[name="' + email_name + '"]')[j].value))
								validated_email = true;
						}
				
					}
				}
			} else{
				if( typeof $('input[name="' + email_name + '"]')[j] !== "undefined" ){
			
					if( $('input[name="' + email_name + '"]')[j].value != "REMOVED"){
									
						if( $('input[name="' + email_name + '"]')[j].value != "" ){
							all_blank = false;
							if(validateEmail($('input[name="' + email_name + '"]')[j].value))
								validated_email = true;
						}
				
					}
					
				}
			}
		
		}
		
		if(has_one_active){
			if(all_blank){
				alert("Some emails are empty. Please fill the email(s) with some info or remove it(them).");
				return false;
			} 
			if(!validated_email){
				alert("Some emails are not correct.");
				return false;
			}
		}
			
	}
	
	return true;

}


function validateForm(){
	
	return validateEmails();
	
}

$(document).ready(function (){

	$(function() {
		polls_response = $.ajax({
			type: "GET",
			url: "db/edit_poll.php?all=true" ,
			cache: false,
			async: false,
			dataType: "json",
			success: function(data){
					
				if(data){
					
				}
					
						
			}
				
		});
		loadScript("js/available_tags.js");
	});
	
	if(typeof $('.avgrund-active')[0] !== "undefined")
		$('.avgrund-active')[0].style.height = "1066px";
	
	$('.share_email').click( function(){
		var id_poll = $("#id_poll").val();
		
		$.ajax({
			type: "GET",
			url: "db/share.php?id_poll=" + id_poll,
			cache: false,
			async: false,
			dataType: "json",
			success: function(data){
					
				var text_div = data;
											
				$('.poll_modal_edit').html(text_div);
				$('.poll_modal_edit').css("display", "none");
				$('.poll_modal_edit').fadeIn("slow");
			},
			error: function(){
				alert("Error");
			}
					
		});
		loadScript("js/emails.js");
		loadScript("js/share.js");
		return false;
	});
		
	$('.remove').click( function(){
		var id_poll = $("#id_poll").val();
		var dataString = "id_poll=" + id_poll;

		$.ajax({
			type: "POST",
			url: "db/remove_poll.php",
			cache: false,
			data: dataString,
			beforeSend: function(){ $(".remove").val('Removing...');},
			dataType: "json",
			success: function(data){
				if(data){
					
					window.location.reload();
				}
						
						
			},
			error: function(){
					alert("An error ocurred.");
			}
		});
		return false;
	});
	
	$('.save').click(function(){
		
		var text_title, _public;
		
		for(i = 0; i <= 10; i++){
		
			if(typeof $('input[class="text_title"]')[i] !== "undefined")
				text_title = $('input[class="text_title"]')[i].value;
				
			if(typeof $('input[class="public"]')[i] !== "undefined")
				_public = $('input[class="public"]')[i].checked;
		
		}
		
		var form = $('.poll_modal_form')[0];
		var formData = new FormData(form);
		formData.append('file', $("#imagefile")[0].files[0]);
		formData.append('text_title', text_title);
		formData.append('_public', _public);
			
		$.ajax({
			type: "POST",
			url: "db/edit_poll.php",
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
					alert("An error ocurred when saving your vote. Please try again.");
				}
				
			},
			error: function(){
				
			}
		});
		return false;
	});
});