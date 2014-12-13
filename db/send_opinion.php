<?
	if( isset( $_POST["send_opinion"] ) ){
	
		require_once "connection.php";
		
		$dbh = connect( $dbm, $db_name );
		
		$name = $_POST["name"];
		$email = $_POST["email"];
		$comments = $_POST["comments"];
		
		$query = "INSERT INTO Opinions(id_opinion, name, email, comments)
				  VALUES(NULL, ?, ?, ?)";
				  
		$stmt = $dbh->prepare( $query );
		$result = $stmt->execute( array( $name, $email, $comments ) );
		
		header("Location: ../send_opinion.php");
		
		
	}
	else
		header("Location: ../error.php");
?>