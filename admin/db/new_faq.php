<?

	if( isset( $_POST["save_bt"] ) ){
	
		require_once "../../db/db.php";
		require_once "../../db/connection.php";
	
		$dbh = connect( $dbm, "../" . $db_name_dir_back );
		
		$question = $_POST["question"];
		$answer = $_POST["answer"];
		
		$result = $dbh->prepare("INSERT INTO Faqs(id_faq, question, answer)
								 VALUES(?, ?, ?)");
								 
		$result->execute( array( NULL, $question, $answer ) );
		
		header("Location: ../faqs.php");
	}
	else
		header("Location: ../polls.php");
?>