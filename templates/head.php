<?
	session_start();
?>

<!DOCTYPE html>	
	<head>
		<meta charset = "UTF-8">
		<title>Poll Online</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="js/jquery-1.10.2.js"></script>
		<script src="js/jquery-ui.js"></script>
		<link rel="stylesheet" href="css/jquery-ui.css">
		<link rel="stylesheet" href="css/avgrund.css">
		<link rel="stylesheet" href="css/modal.css">
		<?
			if( basename($_SERVER["SCRIPT_FILENAME"], '.php') == "register" ){
		?>
		<script src = "js/register.js"></script>
		<?
			} else if( basename($_SERVER["SCRIPT_FILENAME"], '.php') == "login" ){
		?>
		<script src = "js/login.js"></script>
		<?
			} else if( basename($_SERVER["SCRIPT_FILENAME"], '.php') == "send_opinion" ){
		?>
		<script src = "js/send_opinion.js"></script>
		<?
			} else if( basename($_SERVER["SCRIPT_FILENAME"], '.php') == "my_polls" ){
		?>
		<script src = "js/my_polls.js"></script>
		<?
			} else {
		?>
		<script src = "js/polls_response.js"></script>
		<?
			}
		?>
		<link rel = "stylesheet" type = "text/css" href = "css/style.css">
	</head>