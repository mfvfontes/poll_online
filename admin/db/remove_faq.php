<?

	if( isset( $_GET["id_faq"] ) ){
	
		require_once "../../db/db.php";
		require_once "../../db/connection.php";
	
		$dbh = connect( $dbm, "../" . $db_name_dir_back );
		
		$id_faq = $_GET["id_faq"];
	
		$result = $dbh->prepare("DELETE FROM Faqs WHERE id_faq = ?");
								 
		$result->execute( array( $id_faq ) );
		
		header("Location: ../faqs.php");
	}
	else
		header("Location: ../polls.php");
?>