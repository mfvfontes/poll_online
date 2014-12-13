<?

	if( isset( $_POST["about_bt"] ) ){
	
		require_once "../../db/db.php";
		require_once "../../db/connection.php";
		
		$dbh = connect( $dbm, "../" . $db_name_dir_back );
		
		$motivation = $_POST["motivation"];
		$objective = $_POST["objective"];
		$help_us = $_POST["help_us"];
		
		$result = $dbh->prepare("UPDATE About_Us
								 SET motivation = ?,
								 objective = ?,
								 help_us = ?
								 WHERE id_about_us = 1");
		
		$result->execute( array( $motivation, $objective, $help_us ) );
		
		header("Location: ../about_us.php");
	
	}
	else
		header("Location: ../polls.php");

?>