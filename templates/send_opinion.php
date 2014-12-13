<?
	require_once "db/connection.php";
	
	$dbh = connect( $dbm, $db_name_dir );
	
	/**BEGIN SEND_US_YOUR_OPINION SIDEBAR**/
	
	$query = "SELECT Opinions_Sidebar.*, Images.url 
			  FROM Opinions_Sidebar, Images
			  WHERE Opinions_Sidebar.id_image = Images.id_image";
	
	$stmt = $dbh->prepare( $query ) ;
	$result = $stmt->execute();
	
	$opinions_sidebar_items = $stmt->fetchAll();
	
	/**END SEND_US_YOUR_OPINION SIDEBAR**/
?>

<div id = "contact">
	<div id = "info_list">
		<div id = "info_title">
			<h2>Send Us Your Opinion</h2>
		</div>
		<div id = "contact_form">
			<form method = "post" action = "db/send_opinion.php" id = "reg_form" onsubmit = "return validateOpinion()">
				<label>
					Name
					<input type = "text" name = "name" id = "txt_name" required="required">
					<span id = "lbl_name"></span>
				</label>
				<label>
					Email
					<input type = "text" name = "email" id = "txt_email" maxlength = "40" required="required">
					<span id = "lbl_email"></span>
				</label>
				<label>
					Comments
					<textarea name = "comments" rows = "8" cols = "50" required="required"></textarea>
				</label>
				<input type = "submit" name = "send_opinion" value = "Send">
			</form>
		</div>
	</div>
	<div id = "contact_sidebar">
		<div id = "info_title">
			<h3>Opinion Rules</h3>
		</div>
		<? foreach ($opinions_sidebar_items as $item) {?>
		<div id = "info_sidebar_item">
			<div id = "info_img">
				<img src = "<?=$item["url"]?>"/>
			</div>
			<div id = "info_subtitle">
				<h3><?=$item["title"]?></h3>
			</div>
			<div id = "info_text_sidebar">
				<p>
					<?=$item["description"]?>
				</p>
			</div>
		</div>
		<?  } ?>
	</div>

</div>