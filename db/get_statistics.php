<?
	
	if( isset( $_GET["id_poll"] ) ){
	
		require_once "connection.php";		
		
		$dbh = connect( $dbm, $db_name );
		
		$id_poll = $_GET["id_poll"];
		
		$query = "SELECT COUNT(*) AS num_votes FROM Votes
				  WHERE id_poll = ?";
				  
		$stmt = $dbh->prepare( $query );
		$result = $stmt->execute( array( $id_poll ) );
		
		$poll = $stmt->fetch();
		
		$query = "SELECT Answers.id_answer, Answers.description, COUNT(Votes.id_answer) AS num
				  FROM Answers
				  LEFT JOIN Poll ON (Answers.id_poll = Poll.id_poll)
				  LEFT JOIN Votes ON (Answers.id_answer = Votes.id_answer)
				  WHERE Poll.id_poll = ?
				  GROUP BY Answers.id_answer";
				  
		$stmt = $dbh->prepare( $query );
		$result = $stmt->execute( array( $id_poll ) );
		
		$answers_votes = $stmt->fetchAll();
		
		$text = "";
		
		if($poll["num_votes"] == 0){
			foreach($answers_votes as $vote)
				$text .= $vote["description"] . "|" . "0.00 | 0" . "<br>";
			
		} else{
			foreach($answers_votes as $vote)
				$text .= $vote["description"] . "|" . number_format(($vote["num"]/$poll["num_votes"])*100, 2) . "|" . $vote["num"] . "<br>";
		}
		
		echo json_encode( $text );
		
	}
	
?>