<?
	
	require_once "templates/back_head.php";
	
	if( !isset($_SESSION["id_username_root"] ) )
		header("Location: ../error.php");
	
	require_once "templates/back_header.php";
	
	require_once "../templates/begin_main.php";
	require_once "templates/faqs.php";
	require_once "../templates/end_main.php";
	
	require_once "templates/footer.php";

?>