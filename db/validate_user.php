<?
	
	if( isset( $_POST["username"] ) ){
		
		require_once "connection.php";
		
		$dbh = connect( $dbm, $db_name );
		
		$query = "SELECT COUNT(*) AS num FROM User WHERE username = ?";
		
		$result = $dbh->prepare( $query );
				
		$result->execute( array( $_POST["username"] ) );	
		
		$rows = $result->fetch();
		
		if($rows["num"] == 0)
			echo json_encode("true");
		else
			echo json_encode("false");
		
	} else
		header("Location: ../error.php");
?>