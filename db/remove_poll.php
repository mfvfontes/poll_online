<?
	
	if( isset( $_POST["id_poll"] ) ){
		
		require_once "connection.php";
		
		$dbh = connect( $dbm, $db_name );
		
		$result = $dbh->prepare("DELETE FROM Poll WHERE id_poll = ?");
		$result->execute( array( $_POST["id_poll"] ) ); 
		
		sleep(1);
		
		echo json_encode("true");

	}
?>