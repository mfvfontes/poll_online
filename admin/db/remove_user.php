<?
	
	if( isset( $_GET["id_user"] ) ){
	
		require_once "../../db/db.php";
		require_once "../../db/connection.php";
		
		$dbh = connect( $dbm, "../" . $db_name_dir_back );
		
		
		$result = $dbh->prepare("DELETE FROM User WHERE id_user = ?");
		$result->execute( array( $_GET["id_user"] ) ); 
	
	}
	header("Location: ../users.php");
	
?>