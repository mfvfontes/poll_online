<?
	session_start();
?>

<!DOCTYPE html>	
	<head>
		<meta charset = "UTF-8">
		<title>Poll Online BackOffice</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="js/jquery-1.10.2.js"></script>
		<script src="js/jquery-ui.js"></script>
		<link rel="stylesheet" href="css/jquery-ui.css">
		<link rel="stylesheet" href="css/avgrund.css">
		<link rel="stylesheet" href="css/modal.css">
		<!--<script src="js/jquery.avgrund.js"></script> -->
		<?
		if( basename($_SERVER["SCRIPT_FILENAME"], '.php') == "index" ){
		?>
		<script src = "js/back_login.js"></script>
		<?
			} else {
		?>
		<!--<script src = "js/polls_response.js"></script>
		<?
			}
		?>
		<!--<script src = "js/vote.js"></script>-->
		<link rel = "stylesheet" type = "text/css" href = "css/style.css">
	</head>