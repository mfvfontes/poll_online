<?

	if( isset( $_POST["login_button"] ) ){
	
		require_once "../../db/db.php";
		require_once "../../db/connection.php";
		require_once "../../db/user.php";
		
		session_start();
		
		$dbh = connect( $dbm, "../" . $db_name_dir_back );
		
		$username = $_POST["username"];
		$password = $_POST["password"];
		
		$info = array("id" => "",
						 "username" => $_POST["username"],
						 "password" => $_POST["password"],
						 "email" => "",
						 "phone" => "",
						 "type_user" => "");
			
		try{
		
			$user = new User($info);
			
			$id = $user->login($dbh, TRUE);
			
			$_SESSION["username"] = $username;
			$_SESSION["id_username_root"] = $id;
			
			sleep(1);
			
			echo json_encode( "TRUE" );
		
		} catch (NEUException $e){
			
			sleep(1);
		
			echo json_encode( $e->getMessage() );
		}
		
		//$return = "bllb";
		
		//$return["json"] = json_encode($return);
		//echo json_encode($return);
		
		//echo json_encode("fail");
	
	}
	//else
		//header( "Location: ../error.php" );

	
?>