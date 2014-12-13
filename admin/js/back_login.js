$(document).ready(function() {
	$('#login_bt').click(function(){
		var username=$("#txt_username").val();
		var password=$("#txt_password").val();
		var login_bt=$("#login_bt").val();
		var dataString = 'username=' + username + '&password='+ password + '&login_button=' + login_bt;
		if($.trim(username).length > 0 && $.trim(password).length > 0){
			$.ajax({
				type: "POST",
				url: "db/login.php",
				cache: false,
				data: dataString,
				dataType: "json",
				beforeSend: function(){ $("#login_bt").val('Connecting...');},
				success: function(data){
							
					if(data == "TRUE"){
						window.location = "polls.php";
					}
					else{
						document.getElementById("lbl_login").innerHTML = "<p>Username or/and password wrong.</p>";
						$("#login_bt").val('Login');
					}
					
				},
				error: function(){
					alert("GSDG");
				}
			});
		}
		return false;
	});
});