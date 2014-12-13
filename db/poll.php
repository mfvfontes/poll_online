<?
	session_start();
	
	require_once "connection.php";
	
	require_once "polly.php";
	
	function generateResponse($poll, $poll_results, $poll_votes = NULL, $poll_answer = NULL){
		
		$i = 1;
		
		$text = '<div class = "poll_modal">' . 
					'<div id = "poll_modal_title"> 
						<h2>' . $poll["title"] . '</h2>' .
						'<h3>' . $poll["question"] . '</h3>' .
					'</div>';
					
		if( isset ( $_SESSION["username"] ) )
			$text .= '<form id = "poll_modal_form" method = "post">';
		else
			$text .= '<form id = "poll_modal_form">';
					
		foreach($poll_results as $answer){
			$text = $text . '<div id = "poll_modal_div">' .
					  '<label id = "lbl_answer" for = "' . $i . '">';
					  
			if( isset ( $_SESSION["username"] ) ){
				
				if( $poll_votes["num"] == 0 )
					$text .= '<input type = "radio" id = "radio_answer" name = "answer" value = "' .  $answer["description"] .'">';
				else {
					$text .= '<input type = "radio" id = "radio_answer" name = "answer" disabled';
					if( $poll_answer["description"] == $answer["description"] )
						$text .= ' checked ';
					$text .= '>';	
				}
			}
			else
				$text .= '<input type = "radio" id = "radio_answer" name = "answer" disabled>';
			
			$text .= $answer["description"] . '</label>' .
					  '</div>';
			
			$i++;
		}
					
		if( isset ( $_SESSION["username"] ) ){
		
			if( $poll_votes["num"] == 0 )
				$text .= '<input type = "hidden" id = "id_poll" name = "id_poll" value = "' . $poll["id_poll"] . '">' .
						 '<input type = "submit" name = "vote_bt" class="save" value = "Vote">' .
						 '<input type = "submit" class="statistics" value = "Statistics">';
			else
				$text .= '<span> You already voted on this poll. </span>' .
						  '<input type = "hidden" id = "id_poll" name = "id_poll" value = "' . $poll["id_poll"] . '">' .
						  '<input type = "submit" class="statistics" value = "Statistics">';
		}
		else
			$text .= '<span> To vote, you first need to login. You can login <a href = "login.php" >here</a>.</span>';
					'</form>' .
				'</div>';
				
		echo json_encode( $text );
	}
	
	if( isset( $_GET["poll"] ) ){
		
		$dbh = connect( $dbm, $db_name );
		
		$info = array("id" => $_GET["poll"],
					  "title" => "",
					  "question" => "",
					  "public_poll" => "",
					  "id_image" => "",
					  "id_user" => "");
		
		$p = new Poll( $info );
		
		$poll = $p->getData( $dbh, "id_poll" );
					
		$poll_results = $p->getAnswers($dbh, "id_poll");
		
		if( isset( $_SESSION["id_username"] ) ){
		
			$poll_votes = getPollNumVotes( $dbh, $_GET["poll"], $_SESSION["id_username"], "id_poll" );
		
			$poll_answer = getPollVote( $dbh, $_GET["poll"], $_SESSION["id_username"], "id_poll" );
			
			generateResponse($poll, $poll_results, $poll_votes, $poll_answer);
		}
		else
			generateResponse($poll, $poll_results);
		
			
	} else if( isset( $_GET["all"] )  ){
		
		if( $_GET["all"] == "true" ){ //FOR AUTOCOMPLETE
				
			$dbh = connect( $dbm, $db_name );
			
			$polls = getAllPolls($dbh);
			
			$text = "";
					
			foreach( $polls as $poll )
				$text .=  $poll["id_poll"] . "<br>" . $poll["title"] . "<br>";
			
			echo json_encode( $text );
		}
		
	} else if( isset ( $_GET["title"] ) ){
		
		$dbh = connect( $dbm, $db_name );
		
		$info = array("id" => "",
					  "title" => $_GET["title"],
					  "question" => "",
					  "public_poll" => "",
					  "id_image" => "",
					  "id_user" => "");
		
		$p = new Poll( $info );
		
		$poll = $p->getData( $dbh, "title" );
					
		$poll_results = $p->getAnswers($dbh, "title");
		
		if( isset( $_SESSION["id_username"] ) ){
		
			$poll_votes = getPollNumVotes( $dbh, $_GET["title"], $_SESSION["id_username"], "title" );
			
			$poll_answer = getPollVote( $dbh, $_GET["title"], $_SESSION["id_username"], "title" );
		
			generateResponse($poll, $poll_results, $poll_votes, $poll_answer);
		}
		else
			generateResponse($poll, $poll_results);
	
	}
	
?>