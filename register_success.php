<?	
	
	require_once "templates/head.php";
	
	if( !isset( $_SESSION["register_success"] ) )
		header( "Location: error.php" );
	
	require_once "templates/header.php";
	
	require_once "templates/begin_main.php";
	require_once "templates/register_success.php";
	require_once "templates/end_main.php";
	
	require_once "templates/footer.php";

	unset( $_SESSION["register_success"] );
?>