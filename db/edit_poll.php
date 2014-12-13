<?
	
	session_start();
	
	require_once "connection.php";
	
	require_once "polly.php";
	
	function generateResponse($poll, $poll_results){
		
		$i = 1;
		
		$text = '<div class = "poll_modal_edit">' . 
					'<form class = "poll_modal_form" name = "' . $poll["title"] . '" method = "post" enctype = "multipart/form-data">' .
						'<div class = "div_form">' .
						'<div class = "poll_modal_title">' .
							'<h2>Edit Poll | Remove Poll</h2><b>Title</b><br><label class = "lbl_answer">' .
								'<input type = "text" name = "title" class = "text_title" value = "' . $poll["title"] . '">' . 
							'</label>' .
							'<br><b>Public</b><input type = "checkbox" name = "public" class = "public" ';
							if( $poll["public"] == 0)
								$text .= " checked";
							$text .= '><br><label class = "lbl_edit"><b>Image</b></label>' .
										'<img src = "' . $poll["url"] . '">' .
										'<input type = "button" value = "Choose image" onclick ="javascript:document.getElementById(\'imagefile\').click();">' .
										'<input id = "imagefile" type="file" style="visibility: hidden;" name="img">' .
								'</div>';
					
		
					
		/*foreach($poll_results as $answer){
			$text .= '<div id = "poll_modal_div_edit">' .
					    '<label id = "lbl_answer" for = "answer' . $i . '">';
					  			
			$text .= '<input type = "text" class = "txt_answer" name = "answer_' . $i . '" value = "' . $answer["description"] . '">';
			
			$text .= '</label>' .
					  '</div>';
			
			$i++;
		}*/
		//'</div><button class="add_field_button" name = "' . $poll["title"] . '">Add More Fields</button>
		$text .= 
				  '<input type = "hidden" id = "id_poll" name = "id_poll" value = "' . $poll["id_poll"] . '">' .
				 '<input type = "submit" name = "save_bt" class="save" value = "Save">' .
				 '<input type = "submit" name = "remove_bt" class="remove" value = "Remove">' .
				 '<input type = "submit" name = "share_bt" class="share_email" value = "Share By Email">';
		
		$text .= "</form> </div>";
		
		echo json_encode( $text );
	}
	
	if( isset ( $_GET["poll"] ) ){
		
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
		
		generateResponse($poll, $poll_results);
		
	} else if( isset( $_GET["all"] ) ){
	
		$dbh = connect( $dbm, $db_name );
			
		$polls = getMyPolls($dbh, $_SESSION["id_username"]);
			
		$text = "";
					
		foreach( $polls as $poll )
			$text .=  $poll["id_poll"] . "<br>" . $poll["title"] . "<br>";
			
		echo json_encode( $text );
	
	} else if( isset( $_POST["id_poll"] ) ){
	
		$dbh = connect( $dbm, $db_name );
		
		$id_poll = $_POST["id_poll"];
		$title = $_POST["text_title"];
		
		if( isset( $_POST["_public"] ) ){
			if( $_POST["_public"] == "true")
				$public = 0;
			else
				$public = 1;
		}
		
		$info = array("id" => $_POST["id_poll"],
					  "title" => "",
					  "question" => "",
					  "public_poll" => "",
					  "id_image" => "",
					  "id_user" => "");
		
		$p = new Poll( $info );
		
		$poll = $p->getData( $dbh, "id_poll" );
			
		$query = "UPDATE Poll
				  SET title = ?,
				  public = ?
				  WHERE id_poll = ?";
			
		$result = $dbh->prepare( $query );
			
		$result->execute( array( $title, $public, $id_poll ) );	
			
		
		if( !isset( $_POST["file"] ) ){ //THERE IS AN IMAGE
					
			$url = 	"imgs/" . $_FILES["file"]["name"];
				
			move_uploaded_file($_FILES["file"]["tmp_name"], "../imgs/" . $_FILES["file"]["name"]);
		
			$query = "UPDATE Images
					  SET url = ?
					  WHERE id_image = ?";
			
			$result = $dbh->prepare( $query );
			
			$result->execute( array( $url, $poll["id_image"] ) );	
		
		}
		
		sleep(1);
			
		echo json_encode("true");
	} else{
		
		$text = "";
		
		foreach($_POST as $key => $value)
			$text .= $value . ",";
	
		echo json_encode($text);
	}
	
	
?>