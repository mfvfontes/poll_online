<?
	if( isset ( $_POST["vote_bt"] ) ){
		
		require_once "connection.php";
		
		session_start();
		
		$dbh = connect( $dbm, $db_name );
		
		$user_id = $_SESSION["id_username"];
		$poll_id = $_POST["id_poll"];
		
		$query = "SELECT id_answer FROM Answers, Poll
				  WHERE Poll.id_poll = Answers.id_poll
				  AND Poll.id_poll = ?
				  AND Answers.description = ?";
				  
		$stmt = $dbh->prepare( $query );
		$result = $stmt->execute( array( $poll_id, $_POST["option"] ) );
		
		$answer = $stmt->fetch();
			
		$text = $poll_id . ", " . $user_id . ", " . $answer["id_answer"];
		
		$values = array( $poll_id, $user_id, $answer["id_answer"] );
		
		$fields = array( "id_poll", "id_user", "id_answer" );
		
		insert_to_db($dbh, "Votes", $values, $fields);
		
		sleep(1);
				
		echo json_encode($text);
				
	} else
		echo json_encode("false");
?>