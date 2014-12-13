function strrpos(haystack, needle, offset) {
  var i = -1;
  if (offset) {
    i = (haystack + '')
      .slice(offset)
      .lastIndexOf(needle); // strrpos' offset indicates starting point of range till end,
    // while lastIndexOf's optional 2nd argument indicates ending point of range from the beginning
    if (i !== -1) {
      i += offset;
    }
  } else {
    i = (haystack + '')
      .lastIndexOf(needle);
  }
  return i >= 0 ? i : false;
}

$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".div_form"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

	add_button.html("Add Email");

    var x = 1; //initial text box count
    $(add_button).click(function(e){ //on add input button click
	
		var txt_answer_last = $(".txt_email").last()[0].name;
	
		var pos = strrpos(txt_answer_last, '_');
		
		var first_part = "email_";
		var second_part_last = txt_answer_last.substr(pos+1);
		
		var second_part = (parseInt(second_part_last)+1).toString();
		
		//alert(second_part);
		
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div id = "poll_modal_div_edit">' + 
								'<label id = "lbl_answer">' +
									'<input type="text" name="' + first_part + second_part + '" class= "txt_email">' +
								'</label>' +
									'<a href="#" class="remove_field">Remove</a>' +
							  '</div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); 
		$(this).parent('div').remove();
		var div_html = $(this).parent('div').html();
		var div = $(this).parent('div')[0];
		var txt_answer = $(this).parent('div')[0].getElementsByClassName("txt_email")[0];
		$(this).parent('div')[0].getElementsByClassName("txt_email")[0].value = "REMOVED";
		var answer_name = $(this).parent('div')[0].getElementsByClassName("txt_email")[0].name;
		$('input[name="' + answer_name + '"]').val("REMOVED");
		console.log();
		x--;
    })
});