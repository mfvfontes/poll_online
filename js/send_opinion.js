
function isLetter(text){
		var regex = /^[a-zA-Z]+$/;
		return text.match(regex);
	}

	function validateName(name){
		if(name.length > 0){
			if( isLetter(name[0]) )
				return true;
		}
		return false;
	}

	function validateEmail(email) { 
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	} 

	function validateOpinion(){
		var txt_name = document.getElementById("txt_name");
		var txt_email = document.getElementById("txt_email");
		
		if( !validateName(txt_name.value) || !validateEmail(txt_email.value) ){
			alert("There are fields that are not still correct.");
			return false;
		}
		
		alert("Thank you for your opinion and consideration!");
		
		return true;
	}
	
$(document).ready(function (){

	

	$("#txt_name").blur(function () {
		var txt_name = document.getElementById("txt_name");
		if( !validateName(txt_name.value) )	
			document.getElementById("lbl_name").innerHTML = "<p>Enter a valid name.</p>";
		else
			document.getElementById("lbl_name").innerHTML = "";
    }),
	$("#txt_email").blur(function () {
		var txt_email = document.getElementById("txt_email");
		if( !validateEmail(txt_email.value) )	
			document.getElementById("lbl_email").innerHTML = "<p>Enter a valid email.</p>";
		else
			document.getElementById("lbl_email").innerHTML = "";
    });
	
});

