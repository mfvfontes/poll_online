<?
	if( isset( $_POST["send_register"] ) ){

		require_once "connection.php";
		require_once "user.php";
		
		session_start();
		
		$dbh = connect( $dbm, $db_name );
				
		$info = array("id" => NULL,
					  "username" => $_POST["username"],
					  "password" => $_POST["password"],
					  "email" => $_POST["email"],
					  "phone" => $_POST["phone"],
					  "type_user" => User::$ID_NORMAL_USER);
					  
		try{
		
			$user = new User( $info );
			
			if( !$user->register( $dbh ) )
				throw new Exception( "Database Error. Please check the database connection." );
				
		} catch ( Exception $e ){
			echo "[ERROR]: " . $e->getMessage();
			die();
		}
		
		disconnect( $dbh );
		
		$_SESSION["register_success"] = TRUE;
		
		header( "Location: ../register_success.php" );
		
	
	} else{
	
		header( "Location: error.php" );
	
	}
?>