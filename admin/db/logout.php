<?

	session_start();

	if( isset( $_SESSION["id_username_root"] ) ){
		session_destroy();
		
		header( "Location: ../index.php" );
	} else{
		header( "Location: ../error.php" );
	}
	
?>