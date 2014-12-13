<?
	
	function generateResponse(){
		
		$text = '<div class = "poll_modal_edit">' .
					'<form class = "poll_modal_form" name = "share_poll" method = "post">' .
						'<div class = "div_form">' .		
							'<div id = "poll_modal_title"><h2>Share A Poll</h2><b>Emails</b><br></div>' .
							'<div id = "poll_modal_div_edit">' .
								'<label id = "lbl_answer" for = "email1">';
					  			
		$text .= '<input type = "text" class = "txt_email" name = "email_1"></label>' ;
			
		$text .= '</div></div>';
		
		$text .= '<input type = "hidden" name = "id_poll" id = "id_poll" value = "' . $_GET["id_poll"] . '">' .
				 '<input type = "submit" name = "share_bt" class="share" value = "Share">' .
				 '<button class="add_field_button" name = "add_email">Add Email</button>';
		
		$text .= '</form></div>';
		
		echo json_encode( $text );
					
	}
	
	if( isset( $_GET["id_poll"] ) ){
	
		generateResponse();
	
	} else if( isset( $_POST["id_poll"] ) ){
		
		require 'class.phpmailer.php';
		
		$id_poll = $_POST["id_poll"];
		$last_email = $_POST["last_email"];
		
		$body = "Check my poll.<br> Here's the URL: <a href = 'localhost/poll/polls.php?id_poll=" . $id_poll . "'>
													localhost/poll/polls.php?id_poll=" . $id_poll ."</a>";
	
		$mail = new PHPMailer(); // create a new object
		$mail->IsSMTP(); // enable SMTP
		$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true; // authentication enabled
		$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 465; // or 587
		$mail->IsHTML(true);
		$mail->Username = "poll.online.web@gmail.com";
		$mail->Password = "Abcdef.1";
		$mail->SetFrom("poll.online.web@gmail.com");
		$mail->Subject = "Check My Poll!";
		$mail->Body = $body;
		
		for($i = 1; $i <= $last_email; $i++){
			
			$email_name = "email_" . (string)$i;
			
			if( isset ( $_POST[$email_name] ) ){
			
				$email = $_POST[$email_name];
			
				$mail->AddAddress($email);
			
			}
			
		}
		
		sleep(1);
		
		if($mail->Send()){
			echo json_encode("true");
		}
		else{
			echo json_encode("false");
		}
		
	}

?>