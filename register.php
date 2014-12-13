<?

	require_once "templates/head.php";
	
	if( isset( $_SESSION["id_username"] ) )
		header( "Location: error.php" );
	
	require_once "templates/header.php";
	
	require_once "templates/begin_main.php";
	require_once "templates/register.php";
	require_once "templates/end_main.php";
	
	require_once "templates/footer.php";

?>