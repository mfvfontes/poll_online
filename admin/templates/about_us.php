<?
	require_once "../db/db.php";
	require_once "../db/connection.php";
	
	$dbh = connect( $dbm, $db_name_dir_back );
	
	/**BEGIN ABOUT_US INFO**/
	
	$query = "SELECT * FROM About_Us";
	
	$stmt = $dbh->prepare( $query ) ;
	$result = $stmt->execute();
	
	$about_us = $stmt->fetch();
	
	/**END ABOUT_US INFO**/
	
?>

<div id = "about_us">
	<div id = "info_list">
		<div id = "info_title">
			<h2>About Us</h2>
		</div>
		<form method = "post" action = "db/about_us.php">
			<div id = "about_info">
				<h3>Motivation</h3>
				<div id = "info_text">
					<textarea name = "motivation" cols = "70" rows = "5" required = "required"><?=$about_us["motivation"]?></textarea>
				</div>
				<h3>Objective</h3>
				<div id = "info_text">
					<textarea name = "objective" cols = "70" rows = "4"><?=$about_us["objective"]?></textarea>
				</div>
				<h3>Help Us Get Better</h3>
				<div id = "info_text">
					<textarea name = "help_us" cols = "70" rows = "3"><?=$about_us["help_us"]?></textarea>
				</div>
				<input type = "submit" name = "about_bt" value = "Send">
			</div>
		</form>
	</div>
	<div id = "about_sidebar">
		<div id = "info_title">
			<h3>Rules</h3>
		</div>
		
		<div id = "info_sidebar_item">
			<div id = "info_text_sidebar">
				<p>
					Any field has to be filled.
				</p>
				<p>
					Any HTML tags are allowed.
				</p>
			</div>
		</div>
	</div>
</div>