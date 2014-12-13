<?

	if( isset( $_POST["save_bt"] ) ) {
	
		require_once "../../db/db.php";
		require_once "../../db/connection.php";
		require_once "../../db/bcrypt.php";
	
		$dbh = connect( $dbm, "../" . $db_name_dir_back );
	
		$id_user = $_POST["id_user"];
		$username = $_POST["username"];
		$new_password = $_POST["new_password"];
		$id_type_user = $_POST["type_user"];
		$email = $_POST["email"];
		$phone = $_POST["phone"];
			
		$query = "UPDATE User SET username = ?,";
			
		if( $new_password != "")
			$query = $query . " password = ?, ";
			
		$query = $query . "email = ?, phone = ?, id_type_user = ? WHERE id_user = ?";
			
		$result = $dbh->prepare( $query );
			
		if($new_password != ""){
		
			$bcrypt = new Bcrypt(12);

			$hash = $bcrypt->hash($new_password);
			$result->execute( array( $username, $hash, $email, $phone, $id_type_user, $id_user ) );
		}
		else
			$result->execute( array( $username, $email, $phone, $id_type_user, $id_user ) );
			
		header("Location: ../users.php");
		
	} else
		header("Location: ../users.php");

?>