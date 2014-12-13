<?
	session_start();
	
	if( isset( $_POST["security_code"] ) ){
		
		if( $_SESSION['session_textoCaptcha'] == $_POST["security_code"] )
			echo json_encode("true");
		else
			echo json_encode("false");
		
	} else
		header("Location: ../error.php");
?>