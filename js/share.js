
	$('.share').click( function(){
		
		if(!validateForm())
			return false;
		
		var formData = new FormData();
		
		var txt_email_last = $(".txt_email").last()[0].name;
		
		var pos = strrpos(txt_email_last, '_');
			
		var second_part_last = txt_email_last.substr(pos+1);
		
		var last_email = parseInt(second_part_last);
		
		var id_poll = $("#id_poll").val();
		
		formData.append("id_poll", id_poll);
		formData.append("last_email", last_email);
		
		for(i = 1; i <= last_email; i++){
			
			email_name = "email_" + i.toString();
			
			var has_one_active = false;
				
			for(j = 0; j < 100; j++){
				
				if(!has_one_active){
				
					if( typeof $('input[name="' + email_name + '"]')[j] !== "undefined" ){

						if( $('input[name="' + email_name + '"]')[j].value != "REMOVED"){
							
							if( $('input[name="' + email_name + '"]')[j].value != "" ){
								if(validateEmail($('input[name="' + email_name + '"]')[j].value))
									formData.append(email_name, $('input[name="' + email_name + '"]')[j].value);
							}
					
						}
					}
				} 
			}	
		}
			
		$.ajax({
			type: "POST",
			url: "db/share.php",
			cache: false,
			processData: false,
			contentType: false,
			data: formData,
			dataType: "json",
			beforeSend: function(){ $(".share").val('Sending Emails...');},
			success: function(data){
							
				if(data){
					//alert(data);
					window.location.reload();
				}
				else{
					alert("An error ocurred sending emails. Please try again.");
				}
					
			},
			error: function(){
				alert("Error");
			}
		});
			
		return false;
			
	});
