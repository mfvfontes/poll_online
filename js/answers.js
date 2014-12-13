function strrpos(haystack, needle, offset) {
  //  discuss at: http://phpjs.org/functions/strrpos/
  // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // bugfixed by: Onno Marsman
  // bugfixed by: Brett Zamir (http://brett-zamir.me)
  //    input by: saulius
  //   example 1: strrpos('Kevin van Zonneveld', 'e');
  //   returns 1: 16
  //   example 2: strrpos('somepage.com', '.', false);
  //   returns 2: 8
  //   example 3: strrpos('baa', 'a', 3);
  //   returns 3: false
  //   example 4: strrpos('baa', 'a', 2);
  //   returns 4: 2

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

	add_button.html("Add Answer");

    var x = 1; //initial text box count
    $(add_button).click(function(e){ //on add input button click
	
		var txt_answer_last = $(".txt_answer").last()[0].name;
	
		var pos = strrpos(txt_answer_last, '_');
		
		var first_part = "answer_";
		var second_part_last = txt_answer_last.substr(pos+1);
		
		var second_part = (parseInt(second_part_last)+1).toString();
		
		//alert(second_part);
		
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div id = "poll_modal_div_edit">' + 
								'<label id = "lbl_answer">' +
									'<input type="text" name="' + first_part + second_part + '" class= "txt_answer">' +
								'</label>' +
									'<a href="#" class="remove_field">Remove</a>' +
							  '</div>'); //add input box
			
			//inner_html = "GGD";
			
	
			
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); 
		$(this).parent('div').remove();
		var div_html = $(this).parent('div').html();
		var div = $(this).parent('div')[0];
		var txt_answer = $(this).parent('div')[0].getElementsByClassName("txt_answer")[0];
		$(this).parent('div')[0].getElementsByClassName("txt_answer")[0].value = "REMOVED";
		var answer_name = $(this).parent('div')[0].getElementsByClassName("txt_answer")[0].name;
		$('input[name="' + answer_name + '"]').val("REMOVED");
		console.log();
		x--;
    })
});