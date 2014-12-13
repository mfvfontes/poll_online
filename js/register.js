var validation;
var validation_user;

function isLetter(text){
    var regex = /^[a-zA-Z]+$/;
    return text.match(regex);
}

function validateUsername(username){
	return (username.length >= 6 && isLetter(username[0]));
}

function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 

function validatePassword(password){
	var re = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-.]).{8,}$/;
	return re.test(password);
}

function equalPasswords(password, rpassword){
	return (password == rpassword);
}

function validatePhone(phone){
	return (!isNaN(phone) && phone.length == 9);
}

function validateUser(){

	var username = document.getElementById("txt_username").value;
	var dataString = "username=" + username;
	
	validation_user = $.ajax({
		type: "POST",
		url: "db/validate_user.php",
		cache: false,
		async: false,
		data: dataString,
		dataType: "json",
		success: function(data){
						
			if(data){
				if(data == "false"){
					alert("That username is already in use");
				} 
			}
			else{
				alert("An error ocurred when registering. Please try again.");
			}
				
		},
		error: function(){
			alert("Error");
		}
	});
		
	return validation_user.responseJSON;

}

function validateCaptcha(){

	var captcha = document.getElementById("txt_sec_code").value;
	var dataString = "security_code=" + captcha;
	
	validation = $.ajax({
		type: "POST",
		url: "db/validate_captcha.php",
		cache: false,
		async: false,
		data: dataString,
		dataType: "json",
		success: function(data){
						
			if(data){
				if(data == "false"){
					alert("The security code you typed is wrong");
				} 
			}
			else{
				alert("An error ocurred when registering. Please try again.");
			}
				
		},
		error: function(){
			alert("Error");
		}
	});
		
	return validation.responseJSON;
}

$(document).ready(function () {
    $("#txt_username").blur(function () {
		var txt_username = document.getElementById("txt_username");
		if( !validateUsername(txt_username.value) )
			document.getElementById("lbl_username").innerHTML = "<p>Username must have at least 6 characters and start by a letter.</p>";
		else
			document.getElementById("lbl_username").innerHTML = "";
    }),
	$("#txt_password").blur(function () {
		var txt_password = document.getElementById("txt_password");
		if( !validatePassword(txt_password.value) )	
			document.getElementById("lbl_password").innerHTML = "<p>Password must have at least an uppercase and lowercase letter, one digit and one symbol.</p>";
		else
			document.getElementById("lbl_password").innerHTML = "";
    }),
	$("#txt_rpassword").blur(function () {
		var txt_password = document.getElementById("txt_password");
		var txt_rpassword = document.getElementById("txt_rpassword");
		if( !equalPasswords(txt_password.value, txt_rpassword.value) )	
			document.getElementById("lbl_rpassword").innerHTML = "<p>Passwords must be equal.</p>";
		else
			document.getElementById("lbl_rpassword").innerHTML = "";
    }),
	$("#txt_email").blur(function () {
		var txt_email = document.getElementById("txt_email");
		if( !validateEmail(txt_email.value) )	
			document.getElementById("lbl_email").innerHTML = "<p>Enter a valid email.</p>";
		else
			document.getElementById("lbl_email").innerHTML = "";
    }),
	$("#txt_phone").blur(function () {
		var txt_phone = document.getElementById("txt_phone");
		if( !validatePhone(txt_phone.value) )	
			document.getElementById("lbl_phone").innerHTML = "<p>Enter a valid phone number with 9 digits.</p>";
		else
			document.getElementById("lbl_phone").innerHTML = "";
    });
}); 

function validateRegister(){
	var txt_username = document.getElementById("txt_username");
	var txt_password = document.getElementById("txt_password");
	var txt_rpassword = document.getElementById("txt_rpassword");
	var txt_email = document.getElementById("txt_email");
	var txt_phone = document.getElementById("txt_phone");
	
	if( !validateUsername(txt_username.value) || !validatePassword(txt_password.value)
		|| !equalPasswords(txt_password.value, txt_rpassword.value)
		|| !validateEmail(txt_email.value) || !validatePhone(txt_phone.value)){
			alert("There are fields that are not still correct.");
			return false;
	} else{
		var response = validateCaptcha();
		var response_user = validateUser();
				
		if(response == "true" && response_user == "true")
			return true;
		else
			return false;
	}
}