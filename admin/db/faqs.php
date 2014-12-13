<?
	
	if( isset( $_POST["faqs"] ) ){
	
		require_once "../../db/db.php";
		require_once "../../db/connection.php";
		
		$dbh = connect( $dbm, "../" . $db_name_dir_back );
		
		header("Location: ../faqs.php");
	
	}
	
?>