<?

	if( isset( $_POST["save_bt"] ) ){
		
		require_once "../../db/db.php";
		require_once "../../db/connection.php";
	
		$dbh = connect( $dbm, "../" . $db_name_dir_back );
		
		$id_faq = $_POST["id_faq"];
		$question = $_POST["question"];
		$answer = $_POST["answer"];
		
		$result = $dbh->prepare("UPDATE Faqs 
								 SET question = ?,
								 answer = ? 
								 WHERE id_faq = ?");
								 
		$result->execute( array( $question, $answer, $id_faq ) );
			
		header("Location: ../faqs.php");
		
	} else
		header("Location: ../faqs.php");

?>