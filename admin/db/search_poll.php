<?
	
	if( isset( $_GET["id_poll"] ) ){
	
		require_once "../../db/db.php";
		require_once "../../db/connection.php";
		
		$dbh = connect( $dbm, "../" . $db_name_dir_back );
		
		
		$result = $dbh->prepare("DELETE FROM Poll WHERE id_poll = ?");
		$result->execute( array( $_GET["id_poll"] ) ); 

	}
	
	header("Location: ../polls?search_poll=.php");
	
?>