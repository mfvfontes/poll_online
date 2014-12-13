<?
	
	session_start();
	
	require_once "connection.php";
	
	require_once "polly.php";
	
	function generateResponse(){
			
		$text = '<div class = "poll_modal_edit">' . 
					'<form class = "poll_modal_form" name = "create_poll" method = "post" enctype = "multipart/form-data">' .
						'<div class = "div_form">' .
						'<div class = "poll_modal_title">' .
							'<h2>Create Poll</h2><b>Title</b><br><label class = "lbl_answer">' .
								'<input type = "text" name = "title" class = "text_title">' . 
							'</label>' .
							'<br><b>Question</b><br><label class = "lbl_answer">' .
								'<input type = "text" name = "question" class = "text_title">' . 
							'</label>' .
							'<br><b>Public</b><input type = "checkbox" name = "public" class = "public">' .
							'<br><label class = "lbl_edit"><b>Image</b></label>' .
								'<input type = "button" value = "Choose image" onclick ="javascript:document.getElementById(\'imagefile\').click();">' .
								'<input id = "imagefile" type="file" style="visibility: hidden;" name="img">' .
								'<br><b>Answers</b><br>' .
						'</div>';
					
		
			$text .= '<div id = "poll_modal_div_edit">' .
					    '<label id = "lbl_answer" for = "answer1">';
					  			
			$text .= '<input type = "text" class = "txt_answer" name = "answer_1"></label>' ;
			
			$text .= "</div>";
			
			$text .= '<div id = "poll_modal_div_edit">' .
					    '<label id = "lbl_answer" for = "answer1">';
			
			$text .= '<input type = "text" class = "txt_answer" name = "answer_2"></label>';
			
			$text .= "</div>";
			
			$text .= '</label>' .
					  '</div>'.
					  '</div><input type = "submit" name = "save_bt" class="save" value = "Save">' .
					  '<button class="add_field_button" name = "add_answer">Add More Fields</button>';
		
		$text .= "</form> </div>";
		
		echo json_encode( $text );
	}
	
	if( isset( $_POST["title"] ) ){
		
		$dbh = connect( $dbm, $db_name );
		
		$title = $_POST["title"];
		$question = $_POST["question"];
		$total_answers = $_POST["total_answers"];
		$id_user = $_SESSION["id_username"];
		
		if( isset( $_POST["public"] ) )
			$public = 0;
		else
			$public = 1;
		
		$answer_name = "answer_";
		
		//SAVE IMAGE
		
		if( isset( $_POST["file"] ) ){ //THERE'S NO IMAGE
		
			$query = "INSERT INTO Images(id_image, url)
					  VALUES(NULL, ?)";
			
			$result = $dbh->prepare( $query );
				
			$result->execute( array( "imgs/no_image.jpg" ) );	
		
		} else{ //THERE IS AN IMAGE ($_FILES has the values now)
					
			$url = 	"imgs/" . $_FILES["file"]["name"];
				
			move_uploaded_file($_FILES["file"]["tmp_name"], "../imgs/" . $_FILES["file"]["name"]);
		
			$query = "INSERT INTO Images(id_image, url)
					  VALUES(NULL, ?)";
			
			$result = $dbh->prepare( $query );
			
			$result->execute( array( $url ) );	
		
		}
		
		//GET IMAGE ID
		
		$query = "SELECT id_image FROM Images ORDER BY id_image DESC LIMIT 1";
		
		$result = $dbh->prepare( $query );
			
		$result->execute( );
		
		$image = $result->fetch();
		
		//SAVE POLL
		
		$query = "INSERT INTO Poll(id_poll, title, question, public, id_image, id_user)
				  VALUES(NULL, ?, ?, ?, ?, ?)";
		
		$result = $dbh->prepare( $query );
			
		$result->execute( array( $title, $question, $public, $image["id_image"], $id_user ) );	
		
		//GET POLL ID
		
		$query = "SELECT id_poll FROM Poll ORDER BY id_poll DESC LIMIT 1";
		
		$result = $dbh->prepare( $query );
			
		$result->execute( );
		
		$poll = $result->fetch();
		
		for($i = 1; $i <= $total_answers; $i++){
			
			$answer_name = "answer_" . (string)$i;
			
			if( isset ( $_POST[$answer_name] ) ){
			
				$description = $_POST[$answer_name];
			
				$query = "INSERT INTO Answers(id_answer, description, id_poll)
						  VALUES(NULL, ?, ?)";
						  
				$result = $dbh->prepare( $query );
			
				$result->execute( array( $description, $poll["id_poll"] ) );	
			
			}
			
		}
				
		sleep(1);
		
		echo json_encode("true");
	
	} else{
		
		generateResponse();
		
	}
	
		
?>